<?php

/**
 * Project Statuses
 */
$project_statuses = array(
	0 => 'Inception',
	1 => 'Post-Sales',
	2 => 'Documentation',
	3 => 'Designing',
	4 => 'Development',
	5 => 'QA',
	6 => 'Beta Testing',
	7 => 'Go Live',
	8 => 'Deployed',
	9 => 'Delivered',
	10 => 'Payment Received',
	11 => 'Support and Maintainence',
		);

Configure::write('project_statuses', $project_statuses);


/**
 * Task statuses
 */
$task_statuses = array(
	0 => 'Inactive',
	1 => 'Active',
	2 => 'On Hold',
	3 => 'Completed',
	4 => 'Pending',
	5 => 'Re-opened',
	6 => 'Extended',
	7 => 'Support',
	8 => 'Bug-fixing',
	9 => 'Approved',
		);

Configure::write('task_statuses', $task_statuses);

/**
 * Document types
 */
$document_connections = array(
	1 => 'project_id',
		);

Configure::write('document_connections', $document_connections);

/**
 * Comment types
 */
$comment_connections = array(
	1 => 'entry_id',
		);

Configure::write('comment_connections', $comment_connections);

/**
 * Thread types
 */
$thread_types = array(
	1 => 'document_id',
	2=> 'note_id'
		);

Configure::write('thread_types', $thread_types);


