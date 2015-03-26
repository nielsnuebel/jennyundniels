<?php
/**s
 * @author     Niels Nübel <niels@niels-nuebel.de>
 * @link       http://www.nn-medienagentur.de
 * @copyright  (c) 2014 - 2015 Niels Nübel- NN-Medienagentur
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
  ini_set("log_errors", 1);
ini_set("error_log", "hook.log");   //use this to log errors that are found in the script (change the filename and path to a log file of your choosing), the command will make the file automatically
error_reporting(E_ALL);
new deployment;


class deployment {

	/**
	 * @var array whitelisted user for allowed post hooks
	 */
	protected $users = array('Niels Nübel');

	protected $allowedIPs = array(
		'92.51.151.185', // gitlab Server
		'84.180.194.129'
	);

	/**
	 * @var stdClass json decoded
	 */
	protected $payload = null;

	/**
	 * @var string joomla tmp path
	 */
	protected $dir = '';

	final public function __construct()
	{
		try
		{
			$this->handleHook();
			$this->handlePayload();
			$this->handleGit();

		} catch (ErrorException $e)
		{
			echo $e->getMessage();

		} catch (InvalidArgumentException $e)
		{
			echo $e->getMessage();
		}
	}

	protected function handleHook()
	{

		if (isset($GLOBALS['HTTP_RAW_POST_DATA']))
		{
			$HTTP_RAW_POST_DATA = $GLOBALS['HTTP_RAW_POST_DATA'];
		}

		if(!isset($HTTP_RAW_POST_DATA ) || empty($HTTP_RAW_POST_DATA )) {
			throw new InvalidArgumentException('no payload');
		}

		$this->payload = json_decode($HTTP_RAW_POST_DATA );
		
	}
	

	protected function handlePayload()
	{
		if(empty($this->payload))
		{
			throw new InvalidArgumentException('payload empty');
		}

		if(!in_array($_SERVER['REMOTE_ADDR'], $this->allowedIPs))
		{
			throw new InvalidArgumentException('wrong ip: ' . $_SERVER['REMOTE_ADDR']);;
		}

		if(!in_array($this->payload->user_name, $this->users))
		{
			throw new InvalidArgumentException('user not in whitelist');
		}

		if(empty($this->payload->commits))
		{
			throw new InvalidArgumentException('no commits');
		}

	}

	protected function handleGit() {

		echo shell_exec('git pull');
	}
}
?>
