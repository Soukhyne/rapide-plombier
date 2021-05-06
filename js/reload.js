document.addEventListener('DOMContentLoaded', function() {
   //refresh to deconnect inactive user
   function reload(){
      setInterval(function(){
         window.location.reload()
         },15*60*1000)
      }
   reload();
})

