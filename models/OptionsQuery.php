<?php

namespace app\models;

use paulzi\adjacencyList\AdjacencyListQueryTrait;

class OptionsQuery extends \yii\db\ActiveQuery
{
    use AdjacencyListQueryTrait;
}