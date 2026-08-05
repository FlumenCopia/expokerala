/**
 * Google Apps Script for Pre-Registration Form Handling
 * 
 * Features:
 * 1. Robust parameter & array parsing (e.parameter, e.parameters, JSON, urlencoded).
 * 2. Appends pre-registration data to active Google Sheet.
 * 3. Sends beautiful confirmation email directly to registrant with attached .ics iCalendar file.
 */

function doPost(e) {
  try {
    var sheet = SpreadsheetApp.getActiveSpreadsheet().getActiveSheet();
    var data = {};

    // 1. Robust parameter extraction & array sanitization
    if (e && e.parameter && Object.keys(e.parameter).length > 0) {
      data = e.parameter;
    } else if (e && e.parameters && Object.keys(e.parameters).length > 0) {
      data = e.parameters;
    } else if (e && e.postData && e.postData.contents) {
      try {
        data = JSON.parse(e.postData.contents);
      } catch (err) {
        var pairs = e.postData.contents.split('&');
        for (var i = 0; i < pairs.length; i++) {
          var pair = pairs[i].split('=');
          if (pair[0]) {
            data[decodeURIComponent(pair[0])] = decodeURIComponent((pair[1] || '').replace(/\+/g, ' '));
          }
        }
      }
    }

    function sanitizeString(val) {
      if (!val) return '';
      if (Array.isArray(val)) return String(val[0] || '').trim();
      return String(val).trim();
    }

    var timestamp = sanitizeString(data.timestamp) || new Date().toISOString();
    var name = sanitizeString(data.name);
    var countryCode = sanitizeString(data.countryCode);
    var mobile = (countryCode ? '+' + countryCode + ' ' : '') + sanitizeString(data.mobile);
    var email = sanitizeString(data.email);
    var city = sanitizeString(data.city);
    var category = sanitizeString(data.category);
    var days = sanitizeString(data.days); // e.g. "Sep 25" or "Sep 25, Sep 26"

    // 2. Append row to spreadsheet
    sheet.appendRow([
      timestamp,
      name,
      mobile,
      email,
      city,
      category,
      days
    ]);

    // 3. Send reminder email directly to registrant with .ics calendar attachment for selected dates
    var emailResult = 'No email provided';
    if (email && email.indexOf('@') !== -1) {
      emailResult = sendReminderEmail(name, email, days, city, category);
    }

    return ContentService
      .createTextOutput(JSON.stringify({ 
        status: 'success', 
        message: 'Pre-registration saved.',
        emailSentTo: email,
        emailResult: emailResult
      }))
      .setMimeType(ContentService.MimeType.JSON);

  } catch (error) {
    return ContentService
      .createTextOutput(JSON.stringify({ 
        status: 'error', 
        message: error.toString() 
      }))
      .setMimeType(ContentService.MimeType.JSON);
  }
}

/**
 * Calculates start and end ISO strings (in UTC) for Google Calendar Web URL based on selected dates.
 */
function getSelectedDatesRange(daysString) {
  var dateMap = {
    'Sep 25': { start: '20260925T043000Z', end: '20260925T133000Z' },
    'Sep 26': { start: '20260926T043000Z', end: '20260926T133000Z' },
    'Sep 27': { start: '20260927T043000Z', end: '20260927T133000Z' }
  };

  var selected = (daysString || '').split(',').map(function(s) { return s.trim(); }).filter(Boolean);

  if (selected.length === 0) {
    return dateMap['Sep 25'];
  }

  var first = selected[0];
  var last = selected[selected.length - 1];

  var startStr = (dateMap[first] || dateMap['Sep 25']).start;
  var endStr = (dateMap[last] || dateMap['Sep 25']).end;

  return {
    start: startStr,
    end: endStr
  };
}

/**
 * Generates RFC 5545 iCalendar (.ics) content for the registrant's selected date(s).
 */
function generateIcsCalendar(name, email, daysString) {
  var range = getSelectedDatesRange(daysString);
  var dtStamp = new Date().toISOString().replace(/[-:]/g, '').split('.')[0] + 'Z';
  var uid = 'expo26-' + Date.now() + '-' + Math.floor(Math.random() * 1000) + '@expokerala.org';

  var icsLines = [
    'BEGIN:VCALENDAR',
    'VERSION:2.0',
    'PRODID:-//Masters Kerala RE 2.0 EXPO26//NONGMLS v1.0//EN',
    'CALSCALE:GREGORIAN',
    'METHOD:REQUEST',
    'BEGIN:VEVENT',
    'UID:' + uid,
    'DTSTAMP:' + dtStamp,
    'DTSTART:' + range.start,
    'DTEND:' + range.end,
    'SUMMARY:Masters Kerala RE 2.0 EXPO26 (' + daysString + ')',
    'DESCRIPTION:Official Pre-Registration Reminder for ' + name + '\\nEvent: Masters Kerala RE 2.0 EXPO26\\nSelected Days: ' + daysString + '\\nVenue: Puthiyakavu Ground, Thripunithura, Ernakulam\\nTime: 10:00 AM - 7:00 PM IST',
    'LOCATION:Puthiyakavu Ground, Thripunithura, Ernakulam, Kerala, India',
    'STATUS:CONFIRMED',
    'SEQUENCE:0',
    (email ? ('ATTENDEE;CUTYPE=INDIVIDUAL;ROLE=REQ-PARTICIPANT;PARTSTAT=ACCEPTED;CN=' + name + ':mailto:' + email + '\r\n') : '') +
    'BEGIN:VALARM',
    'TRIGGER:-PT24H',
    'ACTION:DISPLAY',
    'DESCRIPTION:Reminder: Masters Kerala RE 2.0 EXPO26 is tomorrow!',
    'END:VALARM',
    'END:VEVENT',
    'END:VCALENDAR'
  ];

  return icsLines.join('\r\n');
}

/**
 * Sends a rich, premium HTML confirmation email to the registrant.
 */
function sendReminderEmail(name, email, days, city, category) {
  if (!email || typeof email !== 'string' || email.indexOf('@') === -1) {
    return 'Invalid email string: ' + String(email);
  }

  var subject = "🎉 Registration Confirmed: Masters Kerala RE 2.0 EXPO26 (" + days + ")";

  var dateRange = getSelectedDatesRange(days);
  var gcalUrl = "https://calendar.google.com/calendar/render?action=TEMPLATE" +
                "&text=" + encodeURIComponent("Masters Kerala RE 2.0 EXPO26 (" + days + ")") +
                "&dates=" + dateRange.start + "/" + dateRange.end +
                "&details=" + encodeURIComponent("Pre-Registration Confirmation for " + name + "\nCategory: " + (category || 'Visitor') + "\nSelected Days: " + days + "\nVenue: Puthiyakavu Ground, Thripunithura, Ernakulam") +
                "&location=" + encodeURIComponent("Puthiyakavu Ground, Thripunithura, Ernakulam, Kerala, India");

  var htmlBody = '<!DOCTYPE html>' +
    '<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"></head>' +
    '<body style="font-family: \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif; background-color: #0b0f19; margin:0; padding:20px; color: #e2e8f0;">' +
    '<div style="max-width: 620px; margin: 0 auto; background: #131927; border-radius: 16px; overflow: hidden; border: 1px solid rgba(255,255,255,0.08); box-shadow: 0 10px 40px rgba(0,0,0,0.5);">' +
      
      '<!-- HEADER -->' +
      '<div style="background: linear-gradient(135deg, #039623, #15321f, #090d16); padding: 36px 30px; text-align: center; border-bottom: 2px solid #039623;">' +
        '<div style="display:inline-block; background: rgba(245, 200, 0, 0.15); border: 1px solid rgba(245,200,0,0.4); color: #f5c800; font-size: 11px; font-weight: 700; padding: 4px 12px; border-radius: 100px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px;">' +
          'OFFICIAL PRE-REGISTRATION CONFIRMED' +
        '</div>' +
        '<h1 style="margin: 0 0 6px 0; font-size: 26px; color: #ffffff; font-weight: 800; tracking: -0.5px;">Masters Kerala RE 2.0 EXPO26</h1>' +
        '<p style="margin: 0; font-size: 14px; color: #a0aec0;">Kerala\'s Premier Renewable Energy Exhibition & Conference</p>' +
      '</div>' +

      '<!-- MAIN CONTENT -->' +
      '<div style="padding: 32px 30px; line-height: 1.6;">' +
        '<p style="font-size: 16px; color: #ffffff; margin-top: 0;">Dear <strong>' + name + '</strong>,</p>' +
        '<p style="font-size: 14.5px; color: #cbd5e1; margin-bottom: 24px;">Your spot for <strong>Masters Kerala RE 2.0 EXPO26</strong> has been successfully reserved! Below are your registration details and event calendar link.</p>' +

        '<!-- CONFIRMATION BADGE CARD -->' +
        '<div style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 12px; padding: 20px; margin-bottom: 28px;">' +
          '<table style="width: 100%; border-collapse: collapse; font-size: 14px;">' +
            '<tr><td style="padding: 6px 0; color: #94a3b8; width: 140px;"><strong>Registrant:</strong></td><td style="color: #ffffff; font-weight: 600;">' + name + '</td></tr>' +
            '<tr><td style="padding: 6px 0; color: #94a3b8;"><strong>Selected Days:</strong></td><td style="color: #22c55e; font-weight: 700;">' + days + ' (September 2026)</td></tr>' +
            '<tr><td style="padding: 6px 0; color: #94a3b8;"><strong>Category:</strong></td><td style="color: #f5c800; font-weight: 600;">' + (category || 'Visitor') + '</td></tr>' +
            '<tr><td style="padding: 6px 0; color: #94a3b8;"><strong>Exhibition Hours:</strong></td><td style="color: #ffffff;">10:00 AM – 7:00 PM IST</td></tr>' +
            '<tr><td style="padding: 6px 0; color: #94a3b8;"><strong>Venue:</strong></td><td style="color: #ffffff;">Puthiyakavu Ground, Thripunithura, Ernakulam</td></tr>' +
          '</table>' +
        '</div>' +

        '<!-- CALENDAR BUTTON & NOTE -->' +
        '<div style="text-align: center; margin: 28px 0;">' +
          '<a href="' + gcalUrl + '" target="_blank" style="background: linear-gradient(135deg, #039623, #026b19); color: #ffffff; padding: 14px 28px; text-decoration: none; border-radius: 10px; font-weight: 700; display: inline-block; font-size: 15px; box-shadow: 0 6px 20px rgba(3, 150, 35, 0.4);">' +
            '📅 Add Selected Days to Google Calendar' +
          '</a>' +
          '<p style="font-size: 12.5px; color: #94a3b8; margin-top: 12px;">' +
            '💡 <em>An interactive <strong>.ics Calendar file</strong> is also attached below for auto-syncing with Outlook / Apple / Gmail calendars.</em>' +
          '</p>' +
        '</div>' +

        '<!-- EXPO HIGHLIGHTS SECTION -->' +
        '<div style="border-top: 1px solid rgba(255, 255, 255, 0.08); padding-top: 24px; margin-top: 24px;">' +
          '<h3 style="color: #ffffff; font-size: 16px; margin-bottom: 14px;">🌟 What to Expect at Expo 2026:</h3>' +
          '<div style="display: grid; gap: 10px; font-size: 13.5px; color: #cbd5e1;">' +
            '<p style="margin: 4px 0;">⚡ <strong>300+ Clean Energy Brands:</strong> Explore cutting-edge Solar, Wind, EV, and Battery Storage innovations.</p>' +
            '<p style="margin: 4px 0;">🤝 <strong>B2B & High-Level Networking:</strong> Meet industry pioneers, government officials, EPCs, and suppliers.</p>' +
            '<p style="margin: 4px 0;">💡 <strong>Technical Conferences:</strong> Attend live product launches and expert panel discussions.</p>' +
          '</div>' +
        '</div>' +

        '<!-- VENUE LOCATION CARD -->' +
        '<div style="background: rgba(3, 150, 35, 0.1); border: 1px solid rgba(3, 150, 35, 0.25); border-radius: 12px; padding: 16px; margin-top: 24px; text-align: center;">' +
          '<p style="margin: 0 0 8px 0; font-size: 14px; color: #22c55e; font-weight: 600;">📍 Venue Location</p>' +
          '<p style="margin: 0 0 12px 0; font-size: 13px; color: #e2e8f0;">Puthiyakavu Ground, Thripunithura, Ernakulam, Kerala</p>' +
          '<a href="https://maps.app.goo.gl/6JspoZZUVwn796Gc6" target="_blank" style="color: #38bdf8; font-size: 13px; font-weight: 600; text-decoration: none;">View Location on Google Maps ➔</a>' +
        '</div>' +

        '<!-- HELPLINE -->' +
        '<div style="border-top: 1px solid rgba(255, 255, 255, 0.08); margin-top: 28px; padding-top: 20px; font-size: 13px; color: #94a3b8; text-align: center;">' +
          '<p style="margin: 0 0 4px 0;">Have questions or need assistance?</p>' +
          '<p style="margin: 0; color: #e2e8f0;">📞 Call Us: <strong style="color:#ffffff;">+91 81298 38288</strong> | ✉️ Email: <a href="mailto:info@solarmasters.org" style="color:#38bdf8; text-decoration:none;">info@solarmasters.org</a></p>' +
        '</div>' +

      '</div>' +

      '<!-- FOOTER -->' +
      '<div style="background: #090d16; padding: 20px; text-align: center; font-size: 12px; color: #64748b; border-top: 1px solid rgba(255,255,255,0.05);">' +
        '<p style="margin: 0 0 6px 0;">Powered by <a href="https://solarmasters.org/" target="_blank" style="color: #22c55e; text-decoration: none; font-weight: 600;">Masters Association</a></p>' +
        '<p style="margin: 0;">© 2026 Masters Kerala RE 2.0 EXPO26. All rights reserved.</p>' +
      '</div>' +

    '</div></body></html>';

  var icsString = generateIcsCalendar(name, email, days);
  var icsBlob = Utilities.newBlob(icsString, 'text/calendar; method=REQUEST; charset=UTF-8', 'event-reminder.ics');

  try {
    MailApp.sendEmail({
      to: email,
      subject: subject,
      htmlBody: htmlBody,
      attachments: [icsBlob]
    });
    return 'MailApp success to ' + email;
  } catch (mErr) {
    try {
      GmailApp.sendEmail(email, subject, "Please view in an HTML compatible email viewer.", {
        htmlBody: htmlBody,
        attachments: [icsBlob]
      });
      return 'GmailApp success to ' + email;
    } catch (gErr) {
      return 'Email error: ' + gErr.toString();
    }
  }
}
