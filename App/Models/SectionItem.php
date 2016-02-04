<?php

class SectionItem extends AppModel {

	protected $table = 'section_item';
	protected $belongsTo = array(
		'table' => 'section',
		'foreign_key' => 'id',
		'inner_key' => 'section_id',
		'join_type' => 'LEFT'
	);

}