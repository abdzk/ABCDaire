<?php
namespace App\Models;

use App\Entity\Categories;
use App\Entity\ABCD;
use App\Entity\Letters;

class Filtres {

    public ?Categories $categories = null;

    public ?ABCD $ABCD = null;

    public ?Letters $letters = null;


}