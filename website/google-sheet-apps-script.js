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
    var category = sanitizeString(data.category || data.Category || data.visit_profile || data['I AM A'] || 'Visitor');
    var days = sanitizeString(data.days || data.Days || data['WHICH DAY(S) WILL YOU ATTEND?'] || 'Sep 25, Sep 26, Sep 27');
    var regType = sanitizeString(data.registration_type || data.regType || (data.firm_name ? 'Exhibitor' : 'Visitor'));
    var company = sanitizeString(data.company_name || data.firm_name || data.company || '');
    var designation = sanitizeString(data.designation || '');
    var badgeNo = sanitizeString(data.badge_no || data.badge_id || data.id || '1');
    var qrId = sanitizeString(data.qr_id || data.id || '1');

    // 3. Send INSTANT WELCOME & CONFIRMATION EMAIL to form submitter
    var emailStatus = "No email address found in form submission";
    if (email && email.indexOf('@') !== -1) {
      emailStatus = sendInstantWelcomeEmail(name, email, days, city, category, regType, company, designation, badgeNo, qrId, mobile);
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
    var regType = getVal('registration_type') || (getVal('firm_name') ? 'Exhibitor' : 'Visitor');
    var name = getVal('name') || getVal('Name') || getVal('FULL NAME');
    var countryCode = getVal('countryCode');
    var mobile = (countryCode ? '+' + countryCode + ' ' : '') + (getVal('mobile') || getVal('Mobile') || getVal('MOBILE NUMBER'));
    var email = getVal('email') || getVal('Email') || getVal('EMAIL ADDRESS');
    var city = getVal('city') || getVal('City') || getVal('CITY / DISTRICT');
    var category = getVal('category') || getVal('visit_profile') || getVal('Category') || getVal('I AM A') || regType;
    var days = getVal('days') || getVal('Days') || getVal('WHICH DAY(S) WILL YOU ATTEND?') || 'Sep 25, Sep 26, Sep 27';
    var company = getVal('company_name') || getVal('firm_name') || '';
    var designation = getVal('designation') || '';

    sheet.appendRow([
      timestamp,
      regType,
      name,
      mobile,
      email,
      city,
      category,
      company,
      designation,
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
 * 1. INSTANT WELCOME EMAIL (Sent immediately to form submitter with QR Code & Badge Details)
 */
function sendInstantWelcomeEmail(name, email, days, city, category, regType, company, designation, badgeNo, qrId, mobile) {
  if (!email || typeof email !== 'string' || email.indexOf('@') === -1) {
    return 'Invalid email string: ' + String(email);
  }

  regType = regType || 'Visitor';
  badgeNo = badgeNo || '1';
  qrId = qrId || '0';
  var formattedBadgeId = 'ReExpo2026/' + String(badgeNo).padStart(4, '0');
  var qrPayload = 'EXPO26:' + String(regType).toUpperCase() + ':' + qrId + ':' + formattedBadgeId + ':' + (mobile || '');
  var qrImageUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=' + encodeURIComponent(qrPayload);

  var visitorObj = {
    name: name,
    profile: category || regType,
    company_name: company || '',
    designation: designation || '',
    city: city || '',
    mobile_number: mobile || ''
  };
  var badgePageUrl = 'badge.html?qr_id=' + qrId + '&badge_no=' + badgeNo + '&visitor=' + encodeURIComponent(JSON.stringify(visitorObj));

  var typeTitle = (regType === 'Exhibitor') ? 'Exhibitor Registration Confirmed' : (regType === 'Visitor' ? 'Visitor Registration Confirmed' : 'Pre-Registration Confirmed');
  var subject = "🎉 Welcome to Masters Kerala RE 2.0 EXPO26 - " + typeTitle + "! (" + days + ")";

  var dateRange = getSelectedDatesRange(days);
  var gcalUrl = "https://calendar.google.com/calendar/render?action=TEMPLATE" +
                "&text=" + encodeURIComponent("Masters Kerala RE 2.0 EXPO26 (" + days + ")") +
                "&dates=" + dateRange.start + "/" + dateRange.end +
                "&details=" + encodeURIComponent(typeTitle + " for " + name + "\nCategory/Role: " + (category || regType) + (company ? ("\nCompany: " + company) : "") + "\nBadge ID: " + formattedBadgeId + "\nSelected Days: " + days + "\nVenue: LuLu Mall, Thiruvananthapuram") +
                "&location=" + encodeURIComponent("LuLu Mall, Thiruvananthapuram, Kerala, India");

  var htmlBody = '<!DOCTYPE html>' +
    '<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"></head>' +
    '<body style="font-family: \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif; background-color: #f1f5f9; margin:0; padding:20px 10px; color: #334155;">' +
    '<!-- MAIN CONTAINER TABLE -->' +
    '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.06);">' +
      
      '<!-- HEADER BANNER -->' +
      '<tr>' +
        '<td style="background: linear-gradient(135deg, #025a27 0%, #047857 50%, #059669 100%); padding: 32px 24px; text-align: center;">' +
          '<div style="display:inline-block; background: rgba(255, 255, 255, 0.2); border: 1px solid rgba(255, 255, 255, 0.4); color: #ffffff !important; font-size: 11px; font-weight: 700; padding: 5px 14px; border-radius: 100px; text-transform: uppercase; letter-spacing: 1.2px; margin-bottom: 12px;">' +
            '✨ WELCOME TO MASTERS EXPO 2026 (' + regType.toUpperCase() + ')' +
          '</div>' +
          '<h1 style="margin: 6px 0; font-size: 24px; color: #ffffff !important; font-weight: 800; letter-spacing: -0.3px; line-height: 1.25;">Masters Kerala RE 2.0 EXPO26</h1>' +
          '<p style="margin: 6px 0 0 0; font-size: 13.5px; color: #e2e8f0 !important; font-weight: 500;">Kerala\'s Premier Renewable Energy Exhibition & Conference</p>' +
        '</td>' +
      '</tr>' +

      '<!-- MAIN CONTENT -->' +
      '<tr>' +
        '<td style="padding: 30px 24px; line-height: 1.6; background-color: #ffffff;">' +
          '<p style="font-size: 16px; color: #0f172a; margin-top: 0; margin-bottom: 12px; font-weight: 600;">Dear <strong>' + name + '</strong>,</p>' +
          '<p style="font-size: 14.5px; color: #334155; margin-bottom: 24px; margin-top: 0;">Welcome! Thank you for registering as a <strong>' + regType + '</strong> for <strong>Masters Kerala RE 2.0 EXPO26</strong>. Your spot has been successfully confirmed!</p>' +

          '<!-- OFFICIAL DIGITAL ENTRY QR BADGE CARD -->' +
          '<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #ffffff; border: 2px solid #047857; border-radius: 14px; margin-bottom: 26px; overflow: hidden; text-align: center;">' +
            '<tr>' +
              '<td style="background: linear-gradient(135deg, #7fee00, #95c841); padding: 12px; color: #0d1117; font-weight: 800; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">' +
                '🎟️ OFFICIAL DIGITAL ENTRY BADGE' +
              '</td>' +
            '</tr>' +
            '<tr>' +
              '<td style="padding: 20px;">' +
                '<p style="margin: 0 0 4px 0; font-size: 12px; color: #64748b; font-weight: 600; text-transform: uppercase;">Badge ID Number</p>' +
                '<h3 style="margin: 0 0 14px 0; font-size: 22px; color: #047857; font-family: monospace; font-weight: 800;">' + formattedBadgeId + '</h3>' +
                '<div style="text-align: center; margin: 12px 0;">' +
                  '<img src="' + qrImageUrl + '" alt="QR Code Badge" width="180" height="180" style="border: 3px solid #e2e8f0; border-radius: 12px; padding: 6px; background: #fff;" />' +
                '</div>' +
                '<p style="font-size: 12.5px; color: #475569; margin: 10px 0 16px 0; font-weight: 500;">📱 Show this QR code on your phone screen at Exhibition entrance for fast entry scanning.</p>' +
                '<a href="' + badgePageUrl + '" target="_blank" style="background: #047857; color: #ffffff !important; padding: 10px 22px; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 13.5px; display: inline-block; box-shadow: 0 3px 10px rgba(4,120,87,0.2);">' +
                  '🖨️ View & Print Official Badge' +
                '</a>' +
              '</td>' +
            '</tr>' +
          '</table>' +

          '<!-- CONFIRMATION DETAILS CARD -->' +
          '<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #047857; border-radius: 12px; margin-bottom: 26px;">' +
            '<tr>' +
              '<td style="padding: 18px 20px;">' +
                '<table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-size: 14px;">' +
                  '<tr><td style="padding: 6px 0; color: #64748b; font-weight: 600; width: 130px;">Badge ID:</td><td style="padding: 6px 0; color: #047857; font-weight: 800; font-family: monospace;">' + formattedBadgeId + '</td></tr>' +
                  '<tr><td style="padding: 6px 0; color: #64748b; font-weight: 600;">Registrant:</td><td style="padding: 6px 0; color: #0f172a; font-weight: 700;">' + name + '</td></tr>' +
                  '<tr><td style="padding: 6px 0; color: #64748b; font-weight: 600;">Registration Type:</td><td style="padding: 6px 0; color: #0f172a; font-weight: 700;">' + regType + '</td></tr>' +
                  (company ? ('<tr><td style="padding: 6px 0; color: #64748b; font-weight: 600;">Company / Firm:</td><td style="padding: 6px 0; color: #0f172a; font-weight: 700;">' + company + (designation ? (' (' + designation + ')') : '') + '</td></tr>') : '') +
                  '<tr><td style="padding: 6px 0; color: #64748b; font-weight: 600;">Selected Days:</td><td style="padding: 6px 0; color: #047857; font-weight: 800;">' + days + ' (September 2026)</td></tr>' +
                  '<tr><td style="padding: 6px 0; color: #64748b; font-weight: 600;">Category:</td><td style="padding: 6px 0;"><span style="background: #fef3c7; color: #b45309; border: 1px solid #fde68a; padding: 2px 10px; border-radius: 6px; font-size: 12.5px; font-weight: 700; display: inline-block;">' + (category || regType) + '</span></td></tr>' +
                  '<tr><td style="padding: 6px 0; color: #64748b; font-weight: 600;">Exhibition Hours:</td><td style="padding: 6px 0; color: #1e293b; font-weight: 600;">10:00 AM – 7:00 PM IST</td></tr>' +
                  '<tr><td style="padding: 6px 0; color: #64748b; font-weight: 600;">Venue:</td><td style="padding: 6px 0; color: #0f172a; font-weight: 700;">LuLu Mall, Thiruvananthapuram</td></tr>' +
                '</table>' +
              '</td>' +
            '</tr>' +
          '</table>' +

          '<!-- CALENDAR CTA BUTTON -->' +
          '<div style="text-align: center; margin: 26px 0 22px 0;">' +
            '<a href="' + gcalUrl + '" target="_blank" style="background: linear-gradient(135deg, #059669, #047857); color: #ffffff !important; padding: 14px 28px; text-decoration: none; border-radius: 10px; font-weight: 700; display: inline-block; font-size: 15px; box-shadow: 0 4px 14px rgba(4, 120, 87, 0.35); text-align: center;">' +
              '📅 Add Selected Days to Google Calendar' +
            '</a>' +
            '<p style="font-size: 12.5px; color: #64748b; margin-top: 10px; margin-bottom: 0;">' +
              '💡 <em>An interactive <strong>.ics Calendar file</strong> is attached to auto-sync with Outlook / Apple / Gmail calendars.</em>' +
            '</p>' +
          '</div>' +

          '<!-- VENUE LOCATION CARD -->' +
          '<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 12px; margin-top: 24px;">' +
            '<tr>' +
              '<td style="padding: 18px; text-align: center;">' +
                '<p style="margin: 0 0 4px 0; font-size: 14px; color: #047857; font-weight: 700;">📍 Venue Location</p>' +
                '<p style="margin: 0 0 10px 0; font-size: 13.5px; color: #1e293b; font-weight: 600;">LuLu Mall, Thiruvananthapuram, Kerala</p>' +
                '<a href="https://maps.google.com/?q=LuLu+Mall+Thiruvananthapuram" target="_blank" style="display: inline-block; background-color: #ffffff; color: #047857; border: 1px solid #a7f3d0; padding: 7px 18px; border-radius: 8px; font-size: 13px; font-weight: 700; text-decoration: none;">View Location on Google Maps ➔</a>' +
              '</td>' +
            '</tr>' +
          '</table>' +

          '<!-- EXPO HIGHLIGHTS SECTION -->' +
          '<div style="border-top: 1px solid #e2e8f0; padding-top: 22px; margin-top: 24px;">' +
            '<h3 style="color: #0f172a; font-size: 15px; margin-top: 0; margin-bottom: 12px; font-weight: 700;">🌟 What to Expect at Expo 2026:</h3>' +
            '<div style="font-size: 13.5px; color: #334155; line-height: 1.6;">' +
              '<p style="margin: 6px 0;">⚡ <strong>300+ Clean Energy Brands:</strong> Explore cutting-edge Solar, Wind, EV, and Battery Storage innovations.</p>' +
              '<p style="margin: 6px 0;">🤝 <strong>B2B & High-Level Networking:</strong> Meet industry pioneers, government officials, EPCs, and suppliers.</p>' +
              '<p style="margin: 6px 0;">💡 <strong>Technical Conferences:</strong> Attend live product launches and expert panel discussions.</p>' +
            '</div>' +
          '</div>' +

          '<!-- HELPLINE -->' +
          '<div style="border-top: 1px solid #e2e8f0; margin-top: 24px; padding-top: 18px; font-size: 13px; color: #64748b; text-align: center;">' +
            '<p style="margin: 0 0 4px 0;">Have questions or need assistance?</p>' +
            '<p style="margin: 0; color: #0f172a; font-weight: 600;">📞 Call Us: <a href="tel:+918129838288" style="color:#047857; text-decoration:none;">+91 81298 38288</a> | ✉️ Email: <a href="mailto:info@solarmasters.org" style="color:#047857; text-decoration:none;">info@solarmasters.org</a></p>' +
          '</div>' +

        '</td>' +
      '</tr>' +

      '<!-- FOOTER -->' +
      '<tr>' +
        '<td style="background-color: #f8fafc; padding: 20px; text-align: center; font-size: 12px; color: #64748b; border-top: 1px solid #e2e8f0;">' +
          '<p style="margin: 0 0 4px 0;">Powered by <a href="https://solarmasters.org/" target="_blank" style="color: #047857; text-decoration: none; font-weight: 700;">Masters Association</a></p>' +
          '<p style="margin: 0;">© 2026 Masters Kerala RE 2.0 EXPO26. All rights reserved.</p>' +
        '</td>' +
      '</tr>' +

    '</table></body></html>';

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
    '<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"></head>' +
    '<body style="font-family: \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif; background-color: #f1f5f9; margin:0; padding:20px 10px; color: #334155;">' +
    '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.06);">' +
      '<tr>' +
        '<td style="background: linear-gradient(135deg, #025a27 0%, #047857 50%, #059669 100%); padding: 28px 24px; text-align: center;">' +
          '<div style="display:inline-block; background: rgba(255, 255, 255, 0.2); border: 1px solid rgba(255, 255, 255, 0.4); color: #ffffff !important; font-size: 11px; font-weight: 700; padding: 4px 14px; border-radius: 100px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">' +
            '⏰ EVENT REMINDER' +
          '</div>' +
          '<h2 style="color: #ffffff !important; margin: 4px 0 0 0; font-size: 22px; font-weight: 800;">Your Expo Date is Almost Here!</h2>' +
        '</td>' +
      '</tr>' +
      '<tr>' +
        '<td style="padding: 28px 24px; line-height: 1.6;">' +
          '<p style="font-size: 15px; color: #0f172a; margin-top: 0;">Dear <strong>' + name + '</strong>,</p>' +
          '<p style="font-size: 14.5px; color: #334155; margin-bottom: 20px;">This is a quick reminder that your selected date for <strong>Masters Kerala RE 2.0 EXPO26</strong> is approaching on <strong>' + days + ' (September 2026)</strong>!</p>' +
          '<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #f59e0b; border-radius: 10px; margin: 20px 0;">' +
            '<tr><td style="padding: 16px 20px; font-size: 14px; color: #1e293b;">' +
              '<p style="margin:0 0 6px 0;"><strong>Timing:</strong> 10:00 AM – 7:00 PM IST</p>' +
              '<p style="margin:0 0 6px 0;"><strong>Venue:</strong> LuLu Mall, Thiruvananthapuram</p>' +
              '<p style="margin:0;"><strong>Category:</strong> ' + category + '</p>' +
            '</td></tr>' +
          '</table>' +
          '<div style="text-align: center; margin: 24px 0 10px 0;">' +
            '<a href="' + gcalUrl + '" target="_blank" style="background: #047857; color: #ffffff !important; padding: 12px 26px; text-decoration: none; border-radius: 8px; font-weight: bold; display: inline-block; font-size: 14.5px;">📅 Open Google Calendar</a>' +
          '</div>' +
          '<p style="font-size: 13px; color: #64748b; text-align: center; margin-bottom: 0;">See you at the Expo!</p>' +
        '</td>' +
      '</tr>' +
      '<tr>' +
        '<td style="background-color: #f8fafc; padding: 16px; text-align: center; font-size: 12px; color: #64748b; border-top: 1px solid #e2e8f0;">' +
          '© 2026 Masters Kerala RE 2.0 EXPO26' +
        '</td>' +
      '</tr>' +
    '</table></body></html>';

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
