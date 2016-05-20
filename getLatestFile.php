<?php


//$type_1 = $argv[1];


class a {
		public $path_cmd = '~/Library/Android/sdk/platform-tools/adb';
		public $dest_dir = '/Users/melissa/Desktop/uTest/';
		public $path_screenShot = "/sdcard/Pictures/Screenshots/";
		public $path_video = "/sdcard/AzRecorderFree/";

	  public function __construct($param) {
				$this->type = $param;	
				$this->path = "";
				$this->lastFile = "";
		}

		function setPath() {
				if ($this->type == 'video') {
						return $this->path = $this->path_video;
				} elseif ($this->type == "screenshot") {
						return $this->path = $this->path_screenShot;
				}
		}

		function getLastFile() {
				$this->path = $this->setPath();

				$cmd_ls = $this->path_cmd.' shell ls '.$this->path."\n";
				$output = shell_exec($cmd_ls);

				$line = explode("\n", $output);
				$last_index = count($line) - 2;
				$this->lastFile = rtrim($line[$last_index]);
				return $this->lastFile;
		}


		function pullFile() {
				$this->lastFile = $this->getlastFile();
				$cmd_pull = $this->path_cmd." ".'pull '.$this->path.$this->lastFile." ".$this->dest_dir;
				$this->cmdExec($cmd_pull);

		}

		function checkFile() {
				$this->pullFile();
				$file = $this->dest_dir.$this->lastFile;

				if (file_exists($file)) {
						print "Ok OK OK =====>>>  ".$this->lastFile."    <<<<=====  has been pulled to ".$this->dest_dir."\n";
				} else {
						print "NG NG NG =====>>>  ".$this->lastFile."    <<<<=====  has not been pulled to ".$this->dest_dir."\n";
				}
			  print "\n";
		}


		function cmdExec($cmd) {
				$line_break = 'IFS='.'\n';
				shell_exec($line_break);
				shell_exec($cmd);
		}
}

clearstatcache();
$class = new a($argv[1]);
$class->checkFile();

?>
