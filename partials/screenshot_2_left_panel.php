<div class="text-center">
<div class="col-md-12 thank">
<span class="thankyou">THANK YOU FOR SIGNING UP!</span>
</div>
<div class="col-md-12 thank">
<div class="col-md-12">
<span class="gst">GUEST</span>
</div>
<?php if (isset($_SESSION["guests"])) : foreach ($_SESSION["guests"] as  $key => $value) : ?>
    <div class="col-md-12">
        <span class="frname"><?=$value["firstName"] . " " . $value["lastName"]?></span>
        <span class="fremail"><?=$value["email"]?></span>
    </div>
<?php endforeach; endif; ?>
</div>
</div>