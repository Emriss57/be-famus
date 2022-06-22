
<style>
  body {
    background-color: red;
    text-align: center;
  }

  .forbiddenContainer{
      height: 100vh;
  }
  

</style>
<div class="forbiddenContainer">

    <h1>Forbidden</h1>
    
    <p>You will be redirect in the homepage</p>

</div>

<script>
    window.setTimeout(function() {
    window.location = '/';
  }, 5000);
</script>
