1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
22
23
24
25
26
27
28
29
30
31
32
33
34
35
36
37
38
39
40
41
42
43
44
45
46
47
48
49
50
51
52
53
54
55
56
57
58
59
60
61
62
63
64
65
66
67
68
69
70
71
72
73
74
75
76
77
78
79
80
81
82
83
84
85
86
87
88
89
90
91
92
93
94
95
96
97
98
99
100
101
102
103
104
105
106
107
108
109
110
111
112
113
114
115
116
117
118
119
120
121
122
123
124
125
126
127
128
129
130
131
132
133
134
135
136
137
138
139
140
141
142
143
144
145
146
147
148
149
150
151
152
153
154
155
156
157
158
159
160
161
162
163
164
165
166
167
168
169
170
171
172
173
174
175
176
177
178
179
180
181
182
183
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
