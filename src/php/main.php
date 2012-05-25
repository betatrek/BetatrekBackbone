<?php

include 'user.php';

    init_database();

  $u = new User();
  $u->setUsername("vinay");
  $u->setPassword("abcd");
  $u->setEmail("vinay@betatrek.com");
  $u->insertUser();
  print $u->getUsername()."\n";

?>
