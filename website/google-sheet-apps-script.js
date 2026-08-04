function doPost(e) {
  var sheet = SpreadsheetApp.getActiveSpreadsheet().getActiveSheet();
  var data = e.parameter;

  sheet.appendRow([
    data.timestamp || new Date().toISOString(),
    data.name || '',
    data.countryCode || '',
    data.mobile || '',
    data.phone || '',
    data.email || '',
    data.city || '',
    data.category || '',
    data.days || '',
    data.source || ''
  ]);

  return ContentService
    .createTextOutput(JSON.stringify({ status: 'success' }))
    .setMimeType(ContentService.MimeType.JSON);
}
