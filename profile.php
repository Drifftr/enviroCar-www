<?
include('header.php');
require_once('assets/includes/connection.php');
?>

<script type="text/javascript">
  //Javascript function to receive GET variables (Syntax: $_GET(['variableName']) ) 
  (function(){
    var s = window.location.search.substring(1).split('&');
      if(!s.length) return;
        var c = {};
        for(var i  = 0; i < s.length; i++)  {
          var parts = s[i].split('=');
          c[unescape(parts[0])] = unescape(parts[1]);
        }
      window.$_GET = function(name){return name ? c[name] : c;}
  }())
  
  function init(){
    user = $_GET(['user']);
    $('#username').html(user);
    getUserFriends();
    getUserGroups();
  }


  function getUserGroups(){
    $.get('./assets/includes/users.php?groupsOf='+user, function(data) {
      if(data == 400 || data == 401 || data == 402 || data == 403 || data == 404){
          console.log('error in getting groups');
      }else{
        data = JSON.parse(data);
        if(data.groups.length > 0 ){
          $('#groups').append('<ul style="margin-bottom: 10px; overflow-y:auto">');
          for(i = 0; i < data.groups.length; i++){
            $('#groups').append('<li class="customLi"><a href="">'+data.groups[i].name+'</a></li>');
          }
          $('#groups').append('</ul>');
        }
      }
    });
  }

  function getUserFriends(){
    $.get('./assets/includes/users.php?friendsOf='+user, function(data) {
      if(data == 400 || data == 401 || data == 402 || data == 403 || data == 404){
          console.log('error in getting groups');
      }else{
        data = JSON.parse(data);
        if(data.users.length > 0 ){
          $('#friends').append('<ul style="margin-bottom: 10px; overflow-y:auto">');
          for(i = 0; i < data.users.length; i++){
            $('#friends').append('<li class="customLi" style="list-style-type:none"><img src="./assets/img/person.svg" style="height: 30px; margin-right: 10px; float:right; "/><a href="profile2.php?user='+data.users[i].name+'">'+data.users[i].name+'</a></li>');
          }
          $('#friends').append('</ul>');
        }

      }
    });
  }

  function addAsFriend(){
    $.post('./assets/includes/users.php?addFriend', {addFriend: user}, 
      function(data){
        if(data == 400 || data == 401 || data == 402 || data == 403 || data == 404){
          console.log('error in adding Friend');
        }else{
          console.log('adding friend successfull');
        }
      });
  }

  function deleteAccount(){
    if(confirm("Are you sure you want to delete your account? This can't be undone!")){
        console.log("blub");
        $.post('./assets/includes/authentification.php?delete', {delete: true }, 
            function(data){
              if(data === 'status:ok'){
                window.location.href = "index.php?deleted";
              }else{
                alert("Deletion has failed. Please try again");
              }
      });
    }
    else{
      console.log("bla");
    }
  }
  
  $(function () {
    init();
});

</script>
 
<div class="container rightband">
  <div class="row-fluid">
    <div class="span4">
      <div class="well sidebar-nav">
        <ul class="nav nav-list">
          <img src="./assets/img/user.jpg" align="center" style="height: 100px; margin-right: 100px; "/>
          <li class="nav-header">Community</li>
          <li>Username:    <b id="username"></b></li>
          <li><a href="javascript:addAsFriend();">Add as Friend</a></li>
          <?
            if($_GET['user'] == $_SESSION['name']){
              echo '<p><a href="" class="btn btn-primary btn-small">Change profile &raquo;</a><a href="javascript:deleteAccount();" class="btn btn-primary btn-small">Delete my Account &raquo;</a></p>';
            }
          ?>
        </ul>
      </div><!--/.well -->
    </div><!--/span-->

    <div class="span8">
      <div id="friends" class="span4">
        <h2>Friends</h2>
      </div>
      <div id="groups" class="span4">
        <h2>Groups</h2>
      </div>
    </div>
  </div>
</div>
      
<?
include('footer.php');
?>
      
         
        
        

     

     
    


    

