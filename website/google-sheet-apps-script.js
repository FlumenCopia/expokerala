/**
 * Google Apps Script for Pre-Registration Form Handling
 * 
 * Features:
 * 1. Appends pre-registration data to active Google Sheet.
 * 2. Creates Google Calendar event(s) for the selected expo date(s) (Sep 25, 26, 27, 2026).
 * 3. Sends confirmation & reminder email to registrant's email address with event details.
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
    var days = data.days || ''; // e.g. "Sep 25, Sep 26"

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

    // 2. Add events to Google Calendar if dates are selected
    var calendarEventsCreated = [];
    if (days) {
      calendarEventsCreated = createCalendarEvents(name, email, days, category);
    }

    // 3. Send reminder email if email address is provided
    if (email) {
      sendReminderEmail(name, email, days, city, category);
    }

    return ContentService
      .createTextOutput(JSON.stringify({ 
        status: 'success', 
        message: 'Pre-registration saved, reminder email sent, and calendar events created.',
        eventsCount: calendarEventsCreated.length 
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
 * Creates Google Calendar event(s) for selected date(s) (Sep 25, 26, 27, 2026, 10:00 AM - 7:00 PM IST).
 */
function createCalendarEvents(name, email, daysString, category) {
  var createdEvents = [];
  var calendar = CalendarApp.getDefaultCalendar();
  if (!calendar) return createdEvents;

  // Map of days to 2026 dates (10:00 AM - 7:00 PM IST = UTC+5:30)
  var dateConfigs = [
    { key: 'Sep 25', start: '2026-09-25T10:00:00+05:30', end: '2026-09-25T19:00:00+05:30' },
    { key: 'Sep 26', start: '2026-09-26T10:00:00+05:30', end: '2026-09-26T19:00:00+05:30' },
    { key: 'Sep 27', start: '2026-09-27T10:00:00+05:30', end: '2026-09-27T19:00:00+05:30' }
  ];

  dateConfigs.forEach(function(config) {
    if (daysString.indexOf(config.key) !== -1) {
      var startTime = new Date(config.start);
      var endTime = new Date(config.end);
      var title = "Masters Kerala RE 2.0 EXPO26";
      var description = "Pre-Registration Reminder for " + name + "\n" +
                        "Event: Masters Kerala RE 2.0 EXPO26\n" +
                        "Category: " + (category || 'Visitor') + "\n" +
                        "Location: Lulu Mall, Trivandrum\n" +
                        "Time: 10:00 AM - 7:00 PM IST";
      var location = "Lulu Mall, Thiruvananthapuram, Kerala, India";

      var options = {
        location: location,
        description: description,
        sendInvites: email ? true : false
      };

      if (email) {
        options.guests = email;
      }

      var event = calendar.createEvent(title, startTime, endTime, options);
      createdEvents.push({
        day: config.key,
        eventId: event.getId()
      });
    }
  });

  return createdEvents;
}

/**
 * Sends an HTML reminder email to the registrant with event & Google Calendar details.
 */
function sendReminderEmail(name, email, days, city, category) {
  var subject = "Pre-Registration Reminder: Masters Kerala RE 2.0 EXPO26";

  var htmlBody = `
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 24px; border: 1px solid #e2e8f0; border-radius: 12px; background-color: #ffffff;">
      <div style="text-align: center; padding-bottom: 20px; border-bottom: 2px solid #039623;">
        <h2 style="color: #039623; margin: 0; font-size: 24px;">Masters Kerala RE 2.0 EXPO26</h2>
        <p style="color: #64748b; font-size: 14px; margin-top: 6px;">Kerala's Premier Renewable Energy Exhibition</p>
      </div>

      <div style="padding: 20px 0;">
        <p style="font-size: 16px; color: #1e293b;">Dear <strong>${name}</strong>,</p>
        <p style="font-size: 14px; color: #475569; line-height: 1.6;">
          Thank you for pre-registering for <strong>Masters Kerala RE 2.0 EXPO26</strong>! This email serves as your official confirmation and event reminder.
        </p>

        <div style="background-color: #f8fafc; padding: 18px; border-radius: 10px; margin: 20px 0; border-left: 4px solid #039623;">
          <h3 style="margin-top: 0; color: #0f172a; font-size: 16px; margin-bottom: 12px;">📌 Registration Details</h3>
          <p style="margin: 6px 0; font-size: 14px; color: #334155;"><strong>Selected Date(s):</strong> ${days}</p>
          <p style="margin: 6px 0; font-size: 14px; color: #334155;"><strong>Venue:</strong> Lulu Mall, Thiruvananthapuram, Kerala</p>
          <p style="margin: 6px 0; font-size: 14px; color: #334155;"><strong>Timing:</strong> 10:00 AM – 7:00 PM IST</p>
          <p style="margin: 6px 0; font-size: 14px; color: #334155;"><strong>Category:</strong> ${category || 'General Visitor'}</p>
          <p style="margin: 6px 0; font-size: 14px; color: #334155;"><strong>City/District:</strong> ${city}</p>
        </div>

        <p style="font-size: 14px; color: #475569; line-height: 1.6;">
          We have added calendar invitations to your registration. You can also click the button below to add the event directly to your Google Calendar:
        </p>
      </div>

      <div style="text-align: center; padding: 15px 0;">
        <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text=Masters+Kerala+RE+2.0+EXPO26&dates=20260925T043000Z/20260927T133000Z&details=Pre-Registration+Reminder+for+Masters+Kerala+RE+2.0+EXPO26.&location=Lulu+Mall,+Trivandrum" 
           style="background-color: #039623; color: white; padding: 14px 28px; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 15px; display: inline-block; box-shadow: 0 4px 12px rgba(3,150,35,0.25);">
          📅 Add Expo to Google Calendar
        </a>
      </div>

      <div style="text-align: center; margin-top: 30px; padding-top: 16px; border-top: 1px solid #f1f5f9; color: #94a3b8; font-size: 12px;">
        <p>Masters Kerala RE 2.0 EXPO26 &bull; Sep 25-27, 2026 &bull; Lulu Mall, Trivandrum</p>
      </div>
    </div>
  `;

  MailApp.sendEmail({
    to: email,
    subject: subject,
    htmlBody: htmlBody
  });
}
