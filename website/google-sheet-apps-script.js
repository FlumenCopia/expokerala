/******************************************************************************
 * Masters Kerala RE 2.0 EXPO26 - Master Google Apps Script
 * 
 * Features:
 * 1. Sheet Recording (record_data): Automatically appends form entries to Sheet.
 * 2. Instant Welcome Email: Automatically sends rich HTML confirmation email & .ics file to submitter.
 * 3. Scheduled Date Reminders: Sends automated morning reminder emails 1 day prior to selected Expo date.
 ******************************************************************************/

// Optional fallback recipient (leave blank to send directly to form submitter)
var TO_ADDRESS = "";

function doPost(e) {
  try {
    Logger.log(JSON.stringify(e));

    // 1. Record form data to active Google Sheet
    record_data(e);

    // 2. Extract submitted parameters
    var data = {};
    if (e && e.parameters && Object.keys(e.parameters).length > 0) {
      data = e.parameters;
    } else if (e && e.parameter && Object.keys(e.parameter).length > 0) {
      data = e.parameter;
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

    var name = sanitizeString(data.name || data.Name || data['FULL NAME']);
    var countryCode = sanitizeString(data.countryCode || data.country_code);
    var mobile = (countryCode ? '+' + countryCode + ' ' : '') + sanitizeString(data.mobile || data.Mobile || data['MOBILE NUMBER']);
    var email = sanitizeString(data.email || data.Email || data['EMAIL ADDRESS']);
    var city = sanitizeString(data.city || data.City || data['CITY / DISTRICT']);
    var category = sanitizeString(data.category || data.Category || data['I AM A']);
    var days = sanitizeString(data.days || data.Days || data['WHICH DAY(S) WILL YOU ATTEND?']);

    // 3. Send INSTANT WELCOME & CONFIRMATION EMAIL to form submitter
    var emailStatus = "No email address found in form submission";
    if (email && email.indexOf('@') !== -1) {
      emailStatus = sendInstantWelcomeEmail(name, email, days, city, category);
    }

    return ContentService
      .createTextOutput(JSON.stringify({
        result: "success",
        message: "Data recorded successfully",
        emailSentTo: email,
        emailStatus: emailStatus
      }))
      .setMimeType(ContentService.MimeType.JSON);

  } catch (error) {
    Logger.log("doPost Error: " + error.toString());
    return ContentService
      .createTextOutput(JSON.stringify({
        result: "error",
        error: error.toString()
      }))
      .setMimeType(ContentService.MimeType.JSON);
  }
}

/**
 * Record submission to Google Sheet responses tab
 */
function record_data(e) {
  var lock = LockService.getDocumentLock();
  try {
    lock.waitLock(30000); // hold off up to 30 sec to avoid concurrent writing
  } catch (lErr) {
    Logger.log("Lock error: " + lErr.toString());
  }

  try {
    var doc = SpreadsheetApp.getActiveSpreadsheet();
    var sheet = doc.getActiveSheet();

    var params = e ? (e.parameters || e.parameter || {}) : {};
    
    function getVal(key) {
      var val = params[key] || '';
      return Array.isArray(val) ? val.join(', ') : String(val);
    }

    var timestamp = new Date();
    var name = getVal('name') || getVal('Name') || getVal('FULL NAME');
    var countryCode = getVal('countryCode');
    var mobile = (countryCode ? '+' + countryCode + ' ' : '') + (getVal('mobile') || getVal('Mobile') || getVal('MOBILE NUMBER'));
    var email = getVal('email') || getVal('Email') || getVal('EMAIL ADDRESS');
    var city = getVal('city') || getVal('City') || getVal('CITY / DISTRICT');
    var category = getVal('category') || getVal('Category') || getVal('I AM A');
    var days = getVal('days') || getVal('Days') || getVal('WHICH DAY(S) WILL YOU ATTEND?');

    sheet.appendRow([
      timestamp,
      name,
      mobile,
      email,
      city,
      category,
      days
    ]);

  } catch (error) {
    Logger.log("record_data Error: " + error.toString());
  } finally {
    try { lock.releaseLock(); } catch(fErr) {}
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
    'DESCRIPTION:Official Pre-Registration Confirmation for ' + name + '\\nEvent: Masters Kerala RE 2.0 EXPO26\\nSelected Days: ' + daysString + '\\nVenue: LuLu Mall, Thiruvananthapuram\\nTime: 10:00 AM - 7:00 PM IST',
    'LOCATION:LuLu Mall, Thiruvananthapuram, Kerala, India',
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
 * 1. INSTANT WELCOME EMAIL (Sent immediately to form submitter)
 */
function sendInstantWelcomeEmail(name, email, days, city, category) {
  if (!email || typeof email !== 'string' || email.indexOf('@') === -1) {
    return 'Invalid email string: ' + String(email);
  }

  var subject = "🎉 Welcome to Masters Kerala RE 2.0 EXPO26 - Pre-Registration Confirmed! (" + days + ")";

  var dateRange = getSelectedDatesRange(days);
  var gcalUrl = "https://calendar.google.com/calendar/render?action=TEMPLATE" +
                "&text=" + encodeURIComponent("Masters Kerala RE 2.0 EXPO26 (" + days + ")") +
                "&dates=" + dateRange.start + "/" + dateRange.end +
                "&details=" + encodeURIComponent("Pre-Registration Confirmation for " + name + "\nCategory: " + (category || 'Visitor') + "\nSelected Days: " + days + "\nVenue: LuLu Mall, Thiruvananthapuram") +
                "&location=" + encodeURIComponent("LuLu Mall, Thiruvananthapuram, Kerala, India");

  var htmlBody = '<!DOCTYPE html>' +
    '<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"></head>' +
    '<body style="font-family: \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif; background-color: #0b0f19; margin:0; padding:20px; color: #e2e8f0;">' +
    '<div style="max-width: 620px; margin: 0 auto; background: #131927; border-radius: 16px; overflow: hidden; border: 1px solid rgba(255,255,255,0.08); box-shadow: 0 10px 40px rgba(0,0,0,0.5);">' +
      
      '<!-- HEADER -->' +
      '<div style="background: linear-gradient(135deg, #039623, #15321f, #090d16); padding: 36px 30px; text-align: center; border-bottom: 2px solid #039623;">' +
        '<div style="display:inline-block; background: rgba(245, 200, 0, 0.15); border: 1px solid rgba(245,200,0,0.4); color: #f5c800; font-size: 11px; font-weight: 700; padding: 4px 12px; border-radius: 100px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px;">' +
          'WELCOME TO MASTERS EXPO 2026' +
        '</div>' +
        '<h1 style="margin: 0 0 6px 0; font-size: 26px; color: #ffffff; font-weight: 800; letter-spacing: -0.5px;">Masters Kerala RE 2.0 EXPO26</h1>' +
        '<p style="margin: 0; font-size: 14px; color: #a0aec0;">Kerala\'s Premier Renewable Energy Exhibition & Conference</p>' +
      '</div>' +

      '<!-- MAIN CONTENT -->' +
      '<div style="padding: 32px 30px; line-height: 1.6;">' +
        '<p style="font-size: 16px; color: #ffffff; margin-top: 0;">Dear <strong>' + name + '</strong>,</p>' +
        '<p style="font-size: 14.5px; color: #cbd5e1; margin-bottom: 24px;">Welcome! Thank you for pre-registering for <strong>Masters Kerala RE 2.0 EXPO26</strong>. Your spot has been successfully confirmed!</p>' +

        '<!-- CONFIRMATION BADGE CARD -->' +
        '<div style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 12px; padding: 20px; margin-bottom: 28px;">' +
          '<table style="width: 100%; border-collapse: collapse; font-size: 14px;">' +
            '<tr><td style="padding: 6px 0; color: #94a3b8; width: 140px;"><strong>Registrant:</strong></td><td style="color: #ffffff; font-weight: 600;">' + name + '</td></tr>' +
            '<tr><td style="padding: 6px 0; color: #94a3b8;"><strong>Selected Days:</strong></td><td style="color: #22c55e; font-weight: 700;">' + days + ' (September 2026)</td></tr>' +
            '<tr><td style="padding: 6px 0; color: #94a3b8;"><strong>Category:</strong></td><td style="color: #f5c800; font-weight: 600;">' + (category || 'Visitor') + '</td></tr>' +
            '<tr><td style="padding: 6px 0; color: #94a3b8;"><strong>Exhibition Hours:</strong></td><td style="color: #ffffff;">10:00 AM – 7:00 PM IST</td></tr>' +
            '<tr><td style="padding: 6px 0; color: #94a3b8;"><strong>Venue:</strong></td><td style="color: #ffffff;">LuLu Mall, Thiruvananthapuram</td></tr>' +
          '</table>' +
        '</div>' +

        '<!-- CALENDAR BUTTON -->' +
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
          '<p style="margin: 0 0 12px 0; font-size: 13px; color: #e2e8f0;">LuLu Mall, Thiruvananthapuram, Kerala</p>' +
          '<a href="https://maps.google.com/?q=LuLu+Mall+Thiruvananthapuram" target="_blank" style="color: #38bdf8; font-size: 13px; font-weight: 600; text-decoration: none;">View Location on Google Maps ➔</a>' +
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
    return 'Instant Welcome Email sent successfully to ' + email;
  } catch (mErr) {
    try {
      GmailApp.sendEmail(email, subject, "Please view in an HTML compatible email viewer.", {
        htmlBody: htmlBody,
        attachments: [icsBlob]
      });
      return 'Instant Welcome Email (GmailApp) sent successfully to ' + email;
    } catch (gErr) {
      Logger.log("Send email failed: " + gErr.toString());
      return 'Email error: ' + gErr.toString();
    }
  }
}

/**
 * 2. SCHEDULED EVENT DAY REMINDER (Triggered automatically prior to selected Expo date)
 */
function sendScheduledDayReminders() {
  var sheet = SpreadsheetApp.getActiveSpreadsheet().getActiveSheet();
  var rows = sheet.getDataRange().getValues();
  if (rows.length <= 1) return;

  var sentCount = 0;
  for (var i = 1; i < rows.length; i++) {
    var name = rows[i][1] || '';
    var email = rows[i][3] || '';
    var days = rows[i][6] || '';
    var category = rows[i][5] || 'Visitor';

    if (email && email.indexOf('@') !== -1 && days) {
      sendEventDayReminderEmail(name, email, days, category);
      sentCount++;
    }
  }
  Logger.log("Scheduled reminders sent to " + sentCount + " registrants.");
}

function sendEventDayReminderEmail(name, email, days, category) {
  var subject = "⏰ Reminder: Masters Kerala RE 2.0 EXPO26 is Coming Up! (" + days + ")";

  var dateRange = getSelectedDatesRange(days);
  var gcalUrl = "https://calendar.google.com/calendar/render?action=TEMPLATE" +
                "&text=" + encodeURIComponent("Masters Kerala RE 2.0 EXPO26 (" + days + ")") +
                "&dates=" + dateRange.start + "/" + dateRange.end +
                "&details=" + encodeURIComponent("Event Reminder for " + name + "\nSelected Days: " + days + "\nVenue: LuLu Mall, Thiruvananthapuram") +
                "&location=" + encodeURIComponent("LuLu Mall, Thiruvananthapuram, Kerala, India");

  var htmlBody = '<!DOCTYPE html>' +
    '<html><head><meta charset="utf-8"></head><body style="font-family: Arial, sans-serif; background-color: #0b0f19; margin:0; padding:20px; color: #e2e8f0;">' +
    '<div style="max-width: 600px; margin: 0 auto; background: #131927; border-radius: 16px; padding: 30px; border: 1px solid rgba(255,255,255,0.08); box-shadow: 0 10px 40px rgba(0,0,0,0.5);">' +
      '<div style="text-align: center; margin-bottom: 20px;">' +
        '<span style="background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.3); color: #22c55e; padding: 4px 14px; border-radius: 100px; font-size: 12px; font-weight: 700;">EVENT REMINDER</span>' +
        '<h2 style="color: #ffffff; margin-top: 10px;">Your Expo Date is Almost Here!</h2>' +
      '</div>' +
      '<p>Dear <strong>' + name + '</strong>,</p>' +
      '<p>This is a quick reminder that your selected date for <strong>Masters Kerala RE 2.0 EXPO26</strong> is approaching on <strong>' + days + ' (September 2026)</strong>!</p>' +
      '<div style="background: rgba(255,255,255,0.04); border-left: 4px solid #f5c800; padding: 16px; margin: 20px 0; border-radius: 6px;">' +
        '<p style="margin:0 0 6px 0;"><strong>Timing:</strong> 10:00 AM – 7:00 PM IST</p>' +
        '<p style="margin:0 0 6px 0;"><strong>Venue:</strong> LuLu Mall, Thiruvananthapuram</p>' +
        '<p style="margin:0;"><strong>Category:</strong> ' + category + '</p>' +
      '</div>' +
      '<div style="text-align: center; margin: 24px 0;">' +
        '<a href="' + gcalUrl + '" target="_blank" style="background: #039623; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 8px; font-weight: bold; display: inline-block;">📅 Open Google Calendar</a>' +
      '</div>' +
      '<p style="font-size: 13px; color: #94a3b8; text-align: center;">See you at the Expo!</p>' +
    '</div></body></html>';

  try {
    MailApp.sendEmail({
      to: email,
      subject: subject,
      htmlBody: htmlBody
    });
  } catch (err) {
    Logger.log("Scheduled reminder error: " + err.toString());
  }
}

/**
 * Run this function once in Apps Script to setup daily automated reminders
 */
function setupDailyReminderTrigger() {
  var triggers = ScriptApp.getProjectTriggers();
  for (var i = 0; i < triggers.length; i++) {
    if (triggers[i].getHandlerFunction() === 'sendScheduledDayReminders') {
      ScriptApp.deleteTrigger(triggers[i]);
    }
  }

  ScriptApp.newTrigger('sendScheduledDayReminders')
    .timeBased()
    .everyDays(1)
    .atHour(8)
    .create();

  Logger.log("Daily 8:00 AM IST reminder trigger created!");
}
