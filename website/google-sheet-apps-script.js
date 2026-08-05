/**
 * Google Apps Script for Pre-Registration Form Handling
 * 
 * Features:
 * 1. Appends pre-registration data to active Google Sheet.
 * 2. Sends confirmation email directly to registrant with attached .ics iCalendar file.
 */

function doPost(e) {
  try {
    var sheet = SpreadsheetApp.getActiveSpreadsheet().getActiveSheet();
    var data = e.parameter || {};

    var timestamp = data.timestamp || new Date().toISOString();
    var name = data.name || '';
    var mobile = (data.countryCode ? '+' + data.countryCode + ' ' : '') + (data.mobile || '');
    var email = data.email || '';
    var city = data.city || '';
    var category = data.category || '';
    var days = data.days || ''; // e.g. "Sep 25" or "Sep 25, Sep 26"

    // 1. Append row to spreadsheet
    sheet.appendRow([
      timestamp,
      name,
      mobile,
      email,
      city,
      category,
      days
    ]);

    // 2. Send reminder email directly to registrant with .ics calendar attachment for selected dates
    if (email) {
      sendReminderEmail(name, email, days, city, category);
    }

    return ContentService
      .createTextOutput(JSON.stringify({ 
        status: 'success', 
        message: 'Pre-registration saved and reminder email sent.'
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
    'DESCRIPTION:Official Pre-Registration Reminder for ' + name + '\\nEvent: Masters Kerala RE 2.0 EXPO26\\nSelected Days: ' + daysString + '\\nVenue: Lulu Mall, Thiruvananthapuram\\nTime: 10:00 AM - 7:00 PM IST',
    'LOCATION:Lulu Mall, Thiruvananthapuram, Kerala, India',
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
 * Sends an HTML reminder email to the registrant with event & Google Calendar details.
 */
function sendReminderEmail(name, email, days, city, category) {
  var subject = "Pre-Registration Confirmed: Masters Kerala RE 2.0 EXPO26 (" + days + ")";

  var dateRange = getSelectedDatesRange(days);
  var gcalUrl = "https://calendar.google.com/calendar/render?action=TEMPLATE" +
                "&text=" + encodeURIComponent("Masters Kerala RE 2.0 EXPO26 (" + days + ")") +
                "&dates=" + dateRange.start + "/" + dateRange.end +
                "&details=" + encodeURIComponent("Pre-Registration Confirmation for " + name + "\nCategory: " + (category || 'Visitor') + "\nSelected Days: " + days + "\nVenue: Lulu Mall, Thiruvananthapuram") +
                "&location=" + encodeURIComponent("Lulu Mall, Thiruvananthapuram, Kerala, India");

  var htmlBody = '<!DOCTYPE html>' +
    '<html><head><meta charset="utf-8"></head><body style="font-family: Arial, sans-serif; background-color: #f4f6f9; margin:0; padding:20px;">' +
    '<div style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">' +
      '<div style="background: linear-gradient(135deg, #039623, #243546); padding: 30px; text-align: center; color: #ffffff;">' +
        '<h1 style="margin: 0; font-size: 24px;">Pre-Registration Confirmed! 🎉</h1>' +
        '<p style="margin-top: 8px; font-size: 15px; opacity: 0.9;">Masters Kerala RE 2.0 EXPO26</p>' +
      '</div>' +
      '<div style="padding: 30px; color: #333333; line-height: 1.6;">' +
        '<p>Dear <strong>' + name + '</strong>,</p>' +
        '<p>Thank you for pre-registering for <strong>Masters Kerala RE 2.0 EXPO26</strong>! This email serves as your official confirmation and event reminder for your selected date(s).</p>' +
        '<div style="background: #f8fafc; border-left: 4px solid #039623; padding: 16px; margin: 20px 0; border-radius: 4px;">' +
          '<p style="margin:0 0 6px 0;"><strong>Selected Date(s):</strong> ' + days + ' (September 2026)</p>' +
          '<p style="margin:0 0 6px 0;"><strong>Timing:</strong> 10:00 AM – 7:00 PM IST</p>' +
          '<p style="margin:0 0 6px 0;"><strong>Location:</strong> Lulu Mall, Thiruvananthapuram</p>' +
          '<p style="margin:0;"><strong>Category:</strong> ' + (category || 'Visitor') + '</p>' +
        '</div>' +
        '<div style="text-align: center; margin: 30px 0;">' +
          '<a href="' + gcalUrl + '" target="_blank" style="background-color: #039623; color: #ffffff; padding: 14px 28px; text-decoration: none; border-radius: 8px; font-weight: bold; display: inline-block; font-size: 15px;">📅 Add Selected Days to Google Calendar</a>' +
        '</div>' +
        '<p style="font-size: 13px; color: #666666;">We have also attached an <strong>iCalendar (.ics)</strong> file to this email so Gmail can automatically render an interactive Google Calendar event card in your inbox.</p>' +
      '</div>' +
      '<div style="background: #eef2f7; padding: 16px; text-align: center; font-size: 12px; color: #666666;">' +
        '© 2026 Masters Kerala RE 2.0 EXPO26. All rights reserved.' +
      '</div>' +
    '</div></body></html>';

  var icsString = generateIcsCalendar(name, email, days);
  var icsBlob = Utilities.newBlob(icsString, 'text/calendar; method=REQUEST; charset=UTF-8', 'event-reminder.ics');

  MailApp.sendEmail({
    to: email,
    subject: subject,
    htmlBody: htmlBody,
    attachments: [icsBlob]
  });
}
