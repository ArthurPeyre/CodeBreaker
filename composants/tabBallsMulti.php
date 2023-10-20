    <div class="layout-column" style="gap: 5px;">
        <div class="layout-row" style="justify-content: space-between;">
            <span id="numCode" style="color: #fff; font-weight: 600;">Code 1</span>
            <span id="score" style="color: #fff; font-weight: 600;">0 Score</span>
        </div>
        <div class="container layout-column">
<?php
for ($i=1; $i <= 4; $i++) {
?>
            <div class="little-layout-row">
                <span style="width: 50px;text-align:center;"><?= $i ?></span>
                <div class="little-layout-row" style="gap: max(12.5%, 20px);">
<?php
    for ($j=1; $j<=4; $j++) {
?>
                    <div class="little-layout-colum balls" id="round-<?= $i ?>">
<?php
include("../uploads/balls/transparent.svg");
?>
                        <span class=""></span>
                    </div>
<?php
    }
?>
                </div>
            </div>
<?php
}
?>
        </div>
    </div>