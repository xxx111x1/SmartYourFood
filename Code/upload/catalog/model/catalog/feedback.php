<?php
class ModelCatalogFeedback extends Model {
	public function addFeedback($data) {
		$this->event->trigger('pre.customer.add', $data);
		$this->db->query("INSERT INTO " . DB_PREFIX . "feedback SET  phone= '" . (int)$this->db->escape($data['phone']). "', email = '" . $this->db->escape($data['email']) . "', message = '" . $this->db->escape($data['message']) . "' , date_added = NOW()");
		$this->event->trigger('post.customer.add', $customer_id);
	}
}