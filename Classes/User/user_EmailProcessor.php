<?php

namespace Cbrunet\CbInk\User;

require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('cb_ink') . 'Classes/Lib/Emogrifier.php';

class user_EmailProcessor {

	public $cObj;

	public function inliner($content, $conf) {
		$emogrifier = new \Pelago\Emogrifier();
		$emogrifier->setHtml($content);
		return $emogrifier->emogrify();
	}

	protected $ignoreTags = array();
	protected $blockElements = array();

	/**
	 * Based on https://github.com/soundasleep/html2text
	 */
	public function html2text($content, $conf) {

		if (isset($conf['ignoreTags'])) {
			$this->ignoreTags = preg_split('/\s*,\s*/', $conf['ignoreTags']);
		}

		if (isset($conf['blockElements'])) {
			$this->blockElements = preg_split('/\s*,\s*/', $conf['blockElements']);
		}

		// replace \r\n to \n
		$content = str_replace("\r\n", "\n", $content);
		// remove \rs
		$content = str_replace("\r", "\n", $content);

		$doc = new \DOMDocument();
		libxml_use_internal_errors(true);  // ignore html5 errors
		if (!$doc->loadHTML($content)) {
			// throw new Html2TextException("Could not load HTML - badly formed?", $html);
		}
		libxml_use_internal_errors(false);

		$output = $this->iterateOverNode($doc, $conf);

		// remove leading and trailing spaces on each line
		$output = preg_replace("/[ \t]*\n[ \t]*/im", "\n", $output);
		// remove leading and trailing whitespace
		$output = trim($output);
		return $output;
	}

	protected function nextChildName($node) {
		// get the next child
		$nextNode = $node->nextSibling;
		while ($nextNode != null) {
			if ($nextNode instanceof \DOMElement) {
				break;
			}
			$nextNode = $nextNode->nextSibling;
		}
		$nextName = null;
		if ($nextNode instanceof \DOMElement && $nextNode != null) {
			$nextName = strtolower($nextNode->nodeName);
		}
		return $nextName;
	}

	protected function prevChildName($node) {
		// get the previous child
		$nextNode = $node->previousSibling;
		while ($nextNode != null) {
			if ($nextNode instanceof \DOMElement) {
				break;
			}
			$nextNode = $nextNode->previousSibling;
		}
		$nextName = null;
		if ($nextNode instanceof \DOMElement && $nextNode != null) {
			$nextName = strtolower($nextNode->nodeName);
		}
		return $nextName;
	}

	protected function iterateOverNode($node, $tags) {
		if ($node instanceof \DOMText) {
		  // Replace whitespace characters with a space (equivilant to \s)
			return preg_replace("/[\\t\\n\\f\\r ]+/im", " ", $node->wholeText);
		}
		if ($node instanceof \DOMDocumentType) {
			// ignore
			return "";
		}

		$nextName = $this->nextChildName($node);
		$prevName = $this->prevChildName($node);
		$name = strtolower($node->nodeName);

		if (in_array($name, $this->ignoreTags)) {
			return "";
		}

		if (isset($node->childNodes)) {
			for ($i = 0; $i < $node->childNodes->length; $i++) {
				$n = $node->childNodes->item($i);
				$text = $this->iterateOverNode($n, $tags);
				$output .= $text;
			}
		}
		if (array_key_exists($name.'.', $tags)) {
			if (isset($tags[$name.'.']['attributes'])) {
				$attributes = preg_split('/\s*,\s*/', $tags[$name.'.']['attributes']);
				foreach ($attributes as $attr) {
					$this->cObj->LOAD_REGISTER(array($attr=>$node->getAttribute($attr)), 'LOAD_REGISTER');
				}
			}
			else {
				$attributes = array();
			}

			$output = $this->cObj->stdWrap($output, $tags[$name.'.']);

			foreach($attributes as $attr) {
				$this->cObj->LOAD_REGISTER(array(), 'RESTORE_REGISTER');
			}
		}

		if (in_array($name, $this->blockElements)) {
			$output = "\n" . $output . "\n";
		}
		if ($name == 'br') {
			$output .= "\n";
		}

		return $output;
	}


}