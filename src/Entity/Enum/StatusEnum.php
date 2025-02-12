<?php

namespace App\Entity\Enum;

enum StatusEnum : string
  {
    case Draft ="Draft";
    case Submitted="Submitted";
    case Approved   ="Approved";
    case Rejected="Rejected";
  }