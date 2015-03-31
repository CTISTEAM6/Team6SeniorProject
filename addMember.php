
<?php
ob_start();
session_start();
 
include('../stylesAndScripts.php');
include("../DB/dbconnect.php");
include "../functions.php";
$flag=detectIntrusion($_SESSION["permissions"],0);
if($flag!="0"&&$flag!="-1"){
$c      = "
 
<html>
    <head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/></head>
 
 
    <script src='../js/jquery.min.js'></script>
    <script src='../js/jquery.multiple.select.js'></script>
    <link rel='stylesheet' href='../css/bootstrap.css' />
    <link rel='stylesheet' href='../css/multiple-select.css' />
    <body id='test' style='background:transparent'>
        <form id='form' onchange='manageButton()'>
            <table class='table table-bordered form-table' style='width:80%;  margin-left: auto; margin-right: auto;'>
                <tr>
                    <th colspan=2 style='text-align:center; color:grey; font-size:200%;'>Member Addition Form</th>
                </tr>
                <tr>
                    <td>
                        <label>Student Id</label>
                    </td>
                    <td>
                        <input placeholder='Student ID' name='stuID' id='stuID' class='form-control' type='text' onkeypress='return event.charCode >=48&&event.                     charCode=57' />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Select the Club</label>
                    </td>
                    <td>
                        <select  id='selectClub' value='Select Club' name='clubID[]' type='select-one'>";
                      $sql    = "select clubID, clubName from clubs";
                      $result = $dbObj->query($sql);
                      $i      = 0;
                      while ($rec = $dbObj->fetchAssoc($result)) {
                          $c .= "
 
                            <option value='{$rec['clubID']}' name='{$rec['clubName']}'>{$rec['clubName']}</option>";
                          $i++;
                      }
                      $c .= "
 
                        </select>
                    </td>
                </tr>
                <input  type='hidden' id='selectedClubs' name='selectedClubs'/>
                <div id='returnS6'></div>
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input placeholder='Name' name='stuName' id='stuName' pattern='.{6,}' title='Six or more characters' class='form-control' type='text' />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Middle Name</label>
                    </td>
                    <td>
                        <input placeholder='Middle Name' name='middleName' id='middleName' class='form-control' type='text' />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Surname</label>
                    </td>
                    <td>
                        <input placeholder='Surname' name='stuSurname' id='stuSurname' class='form-control' type='text' />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for='inputError' class='control-label'>E-Mail Address</label>
                    </td>
                    <td>
                        <input placeholder='Student E-Mail' name='stuEMail' id='stuEMail' class='form-control' type='text' onkeyup='formControl(this);'/>
                    </td>
                </tr>
                  <tr>
                    <td>
                        <label class='control-label'>Member Phone</label>
                    </td>
                    <td>
                        <input placeholder='Ex:(532-222-22-22)' name='stuPhone' id='stuPhone' class='form-control' type='text'/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class='control-label'>Member Adress</label>
                    </td>
                    <td>
                        <textarea placeholder='Member Address' name='stuAddress' id='stuAddress' class='form-control' > </textarea>
                    </td>
                </tr>
                <img style='visibility:hidden;' id='wrongIcon' src='https://www.hscripts.com/freeimages/icons/symbols/famous/wrong/wrong-icon5.gif' alt='' />
            </table>
        <input type='submit' value='Add The Student' style='margin-left:45%;' id='addButton' disabled='true' class='btn bg-orange btn-flat margin'>
        </form>
        <div id='res'></div>
 
<script type='text/javascript'>
 
function regControl(pattern, value)
{
   r = new RegExp(pattern, 'g');
   return r.test(value);
}
 
function formControl(e){
 
     patternEposta   = '^'+'([abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0-9_\.\-]+)'+'@'+'([abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0-9_\.\-]+)'+'[\.]'+'([abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0-9_\.\-]+)'+'$';
     document.getElementById('stuEMail').style.backgroundImage='none';
     document.getElementById('stuEMail').style.borderColor='#cccccc';
     if(e.value.length!=0)
     if ( !regControl(patternEposta,e.value))
     {
          document.getElementById('stuEMail').style.backgroundImage = 'url(\"https://www.hscripts.com/freeimages/icons/symbols/famous/wrong/wrong-icon5.gif\")';
          document.getElementById('stuEMail').style.backgroundRepeat = 'no-repeat';
          document.getElementById('stuEMail').style.backgroundPosition = 'center right';
          document.getElementById('stuEMail').style.borderColor='#f56954';
          e.focus();
          return false;
     }
     document.getElementById('wrongIcon').style.visibility = 'hidden';
     return true;
}
 
 
        $(function() {
          $('#selectClub').change(function() {
              console.log($(this).val());
          }).multipleSelect({
              width: '100%'
          });
      });
        $('#form').on('submit', function (e) {
 
            e.preventDefault();
            $.ajax({
              type: 'post',
              url: 'addMemberToDB.php',
              data: $('form').serialize(),
              success: function (response) {
                $('#res').html(response);
                      resetAddMemberForm();
              }
            });
          });
        function resetAddMemberForm(){
            document.getElementById('selectClub').value='';
            document.getElementById('stuID').value='';
            document.getElementById('stuName').value='';
            document.getElementById('stuSurname').value='';
            document.getElementById('stuEMail').value='';
        }
        function manageButton() {
        if ($('#stuID').val().length>0&&$('#stuName').val().length>0&&$('#stuSurname').val().length>0 && $('#selectClub :selected').text().length>0) {
            $('#addButton').attr('disabled', false);
        } else {
            $('#addButton') .attr('disabled', true);
        }
 
 
        };
        </script>
        </html>
        ";
print $c;
}else{
  header("location:../logout.php");
}
 
 
?>
