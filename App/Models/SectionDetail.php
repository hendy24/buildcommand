<?php

class SectionDetail extends AppModel {

	protected $table = 'section_detail';
	protected $belongsTo = array(
		'table' => 'section_item',
		'foreign_key' => 'id',
		'inner_key' => 'section_item_id',
		'join_type' => 'LEFT'
	);

}