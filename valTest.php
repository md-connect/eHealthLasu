<?php
 echo ("Oyindamola hashed using MD5 =".md5("Oyindamola"));
echo ("<br>Oyindamola hashed using hash function =" . password_hash("Oyindamola", PASSWORD_DEFAULT));
