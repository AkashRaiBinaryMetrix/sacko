function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes;
  return strTime;
}

function formatAMPMUnit(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';
  var strTime = ampm;
  return strTime;
}

//check if record for current system date exists
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();
today = mm + '-' + dd + '-' + yyyy;

var form_data = new FormData();

form_data.append("punch_date", today);
form_data.append("_token", $("#token").val());
   
$.ajax({
          url:"getTodayAttendanceData",
          method:"POST",
          data: form_data,
          contentType: false,
          cache: false,
          processData: false,  
          success:function(data)
          {  
          	 //alert(data);

             if(data === '0'){
             	//display punch-in button
             	$("#punchin").show();
             	$("#punchout").hide();
             	$("#mark_state").val('in');
             	$("#current_date").val(today);
             	$("#current_time").val(formatAMPM(new Date));
             	$("#ampm").val(formatAMPMUnit(new Date));
             }else if(data !== '0'){
             	//display punch-out button
             	$("#punchin").hide();
             	$("#punchout").show();
             	$("#mark_state").val('out');
             	$("#current_date").val(today);
             	$("#current_time").val(formatAMPM(new Date));
             	$("#ampm").val(formatAMPMUnit(new Date));
             }else{
             	$("#punchin").hide();
             	$("#punchout").hide();
             }
          }
});

$("#display_time").val(formatAMPM(new Date)+' '+formatAMPMUnit(new Date));