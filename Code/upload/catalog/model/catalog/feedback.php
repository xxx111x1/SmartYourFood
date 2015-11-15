<?php
class ModelCatalogFeedback extends Model {
	public function addFeedback($data) {
		$this->event->trigger('pre.feedback.add', $data);
		$this->log->write('enter add feedback');
		$queryStr = "INSERT INTO " . DB_PREFIX . "feedback SET  phone= '" . (int)$this->db->escape($data['phone']). "', email = '" . $this->db->escape($data['email']) . "', message = '" . $this->db->escape($data['message']) . "' , date_added = NOW()";
		$this->log->write($queryStr);
		$this->db->query("INSERT INTO " . DB_PREFIX . "feedback SET  phone= '" . (int)$this->db->escape($data['phone']). "', email = '" . $this->db->escape($data['email']) . "', message = '" . $this->db->escape($data['message']) . "' , date_added = NOW()");
		$this->log->write('after add feedback');
		$this->event->trigger('post.feedback.add', $data);
	}
}