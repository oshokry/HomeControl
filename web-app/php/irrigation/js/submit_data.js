function Irrigate(x) {
    var id = x;
    var minutes = $("#minutes").val();
    var seconds = $("#seconds").val();
    var total = Number(60 * minutes) + Number(seconds);
//    console.log(total);
    if(total > 0) {
      $.post(
        "irrigate.php",
        { id: id, seconds:total }
      );
    }
}

function SubmitS1() {
  Irrigate("1");
}

function SubmitS2() {
  Irrigate("2");
}

function SubmitS3() {
  Irrigate("3");
}

function SubmitS4() {
  Irrigate("4");
}

function SubmitS5() {
  Irrigate("5");
}

function SubmitS6() {
  Irrigate("6");
}

function SubmitClose() {
    $.post(
      "close.php"
    );
}

function ListSchedule(dayTxt, solText) {
  $.post(
    "listSchedule.php",
    { dayTxt: dayTxt, solText:solText },
    function(data) {
     $('#listSchedule').html(data);
    }
  );
}

function AddEntry() {
  var markup = '<tr><td><input type="checkbox" name="row"/></td><td><input type="text" name ="startTime"/></td><td><input type="text" name="lengthSeconds"/></td><td><input type="checkbox" name="enabled"/></td><td><input type="checkbox" name="oneOff"/></td></tr>';
  $('#Entries tbody').append(markup);
}

function SaveEntries() {
  var newEntriesList = new Array();
      
  $('#Entries tr').each(function(row, tr){
      newEntriesList[row]={
          "startTime" : $(tr).find('td:eq(1)').find('input').val()
          , "lengthSeconds" : $(tr).find('td:eq(2)').find('input').val()
          , "enabled" : $(tr).find('td:eq(3)').find('input:checkbox:first').prop('checked')
          , "oneOff" : $(tr).find('td:eq(4)').find('input:checkbox:first').prop('checked')
      }
  }); 
  
  newEntriesList.shift();  // first row is the table header - so remove
//  console.log(newEntriesList);
  newEntriesList = $.toJSON(newEntriesList);
//  console.log(newEntriesList);

  $.post(
    "saveEntries.php",
    { newEntriesList: newEntriesList },
    function(data) {
     $('#testSchedule').html(data);
    }
  );
}

function DeleteEntries() {
  $('#Entries tbody').find('input[name="row"]').each(function(){
  	if($(this).is(":checked")){
          $(this).parents("tr").remove();
      }
  });
}
