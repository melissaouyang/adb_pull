<?php

class AdbPullFile {

		public function AdbPullFile() {
				$this->source_dir = "/sdcard/DCIM/Camera/";
				$this->dest_dir = "/Users/melissa/Desktop/";
				$this->source_file = "20160413_16*.jpg";
		}

		function ListFile() {
				//$file_lists = array();
				//$cmd = "adb shell ls $this->source_dir$this->source_file | tr '\n\r' ' ' | xargs -n1";
				//$cmd = "adb shell ls $this->source_dir$this->source_file | tr '\n\r' ' '";
				$cmd = "adb shell ls $this->source_dir$this->source_file";

				$file_lists = shell_exec($cmd);
				$file_lists = explode("\r\n", $file_lists);
				$file_count = count($file_lists);
				print_r($file_lists);
				return array($file_lists, $file_count);
		}

		function PullFile($file_lists, $file_count) {
				for ($i = 0; $i < $file_count; $i++) {
						$file_name = trim($file_lists[$i]);
						print "file_name is ".$file_name."\n";
						//if ($file_name != "") {
								//$cmd_pull = "adb pull $file_name $this->dest_dir";
								//shell_exec($cmd_pull);
						//}
				}
		}

		function checkFile() {
				$cmd = "ls $this->dest_dir$this->source_file";
				$files = shell_exec($cmd);
				print_r($files);
		}


}

$obj = new AdbPullFile();
List($file_lists, $file_count) = $obj->ListFile();
$obj->PullFile($file_lists, $file_count);
$obj->checkFile();



