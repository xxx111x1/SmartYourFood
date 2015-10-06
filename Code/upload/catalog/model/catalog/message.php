<?php
class ModelCatalogMessage extends Model {
	public function getMessage() {		
		$customer_id = 0;
		if($this->customer->getId())
		{
			$customer_id = $this->customer->getId();
		}	
		$this->event->trigger('pre.message.get', $customer_id);
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "message where customer_id = '". $customer_id ."' and is_read = 0 ");
		$this->event->trigger('post.message.get', $customer_id);
		return $query->rows;		
	}
	
	public function readMessage($message_ids) {

		$this->event->trigger('pre.message.read', $message_ids);
		$query = $this->db->query("update " . DB_PREFIX . "message set is_read = 1 where message_id in (". $message_ids .")");
		$this->event->trigger('post.message.read', $message_ids);
	}
}