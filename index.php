<?php
echo '<div class="container" style="width=70%; margin-inline=auto; text-align: center;">';
echo "<h1>Booking Forn</h1>";
echo '<form action="">
 <input type="text" style="margin-block: 15px; padding: 15px; min-height: 50px;" placeholder="First Name"><br>
 <input type="text" style="margin-block: 15px; padding: 15px; min-height: 50px;" placeholder="Last Name"><br>
<div style="display: flex; justify-content: center; flex-direction: column; ">
<label style="flex: 1;" for="check">Does third Name exist?</label>
 <input id="check" type="checkbox" style="margin-block: 15px; padding: 15px; min-height: 50px;" placeholder="Last Name"><br>
</div>
 <button class="button" style="padding: 2em; min-height: 50px;" >Go Booking!</button>
</form>';
echo '</div>';
