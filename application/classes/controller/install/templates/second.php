<div class="title">Verification activity PHP modules</div>
<ul class="list">
    <li class="<?if ($settings['lib_php']) {?>itsok<?}else{?>error<?}?>">PHP 5.3 >=</li>
    <li class="<?if ($settings['lib_fgs']) {?>itsok<?}else{?>error<?}?>">file_get_contents() support remote connect</li>
    <li class="<?if ($settings['lib_sock']) {?>itsok<?}else{?>error<?}?>">fsockopen() is available</li>
    <li class="<?if ($settings['lib_xml']) {?>itsok<?}else{?>error<?}?>">SimpleXml is available</li>
    <li class="<?if ($settings['lib_ftp']) {?>itsok<?}else{?>error<?}?>">ftp_connect() is available</li>
    <li class="<?if ($settings['lib_gd2']) {?>itsok<?}else{?>error<?}?>">GD2 Library available</li>
</ul>

<div class="title">Check dir & files permission access</div>
<ul class="list">
    <li class="<?if ($settings['per_cache']) {?>itsok<?}else{?>error<?}?>">/application/cache/ 0777</li>
    <li class="<?if ($settings['per_logs']) {?>itsok<?}else{?>error<?}?>">/application/logs/ 0777</li>
    <li class="<?if ($settings['per_backup']) {?>itsok<?}else{?>error<?}?>">/uploads/backup/ 0777</li>
    <li class="<?if ($settings['per_images']) {?>itsok<?}else{?>error<?}?>">/uploads/images/ 0777</li>
    <li class="<?if ($settings['per_config']) {?>itsok<?}else{?>error<?}?>">config.xml 0644</li>
</ul>

<?if ($all_ok) {?>
    <button class="button" onclick="aprove_step1()">Next</button>
<?}else{?>
    <button class="button" onclick="update_page()">Refresh</button>
<?}?>