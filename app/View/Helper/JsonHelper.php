<?php
class JsonHelper extends AppHelper {
	public function JsonHelper() {	}
	
	public function render ($data = null) {
		if (!$data) return null;
		if (is_string($data)) return json_encode(json_decode($data));
		if (is_array($data)) return json_encode($data);
		return $data;
	}
}
?>