<?php
/**
* 
*/
/*class Queue {
    private $_id_queue;
    static $list_queue;
    function __construct($ip) {
        $this->ip = $ip;
        self::$list_queue[$this->ip][] = $ip;
        shmop_close();*/
        /*$this->_id_queue = isset(self::$list_queue[$this->ip]) ? (end(self::$list_queue[$this->ip])+1) : 1;
    }
/*    public function exec() {
        self::$list_queue[$this->ip][] = $this->_id_queue;
        print_r(self::$list_queue[$this->ip]);
        $my_turn = fasle;
        do {
            if (current(self::$list_queue[$this->ip]) == $this->_id_queue) {
                $my_turn = true;
                print("i started to exec");
                sleep(20);
                print("i finished to exec");
                self::$list_queue[$this->ip] = array_shift(self::$list_queue[$this->ip]);
                break;
            } else {
                print("i am waiting");
            }
        } while (!$my_turn);
    }*/
/*    public function get_id_queue() {
        print_r(self::$list_queue[$this->ip]);
    }
}
$a = new Queue($argv[1]);
$b = new Queue($argv[1]);
$b->get_id_queue();
sleep(60);*/
/*$a[] = 1;
print_r($a);
$a[] = 2;
print_r($a);*/
// Create 100 byte shared memory block with system id of 0xff3
function custom_ftok($pathname, $proj){
        $ftok=false;
        
        if(function_exists('ftok')){
        
            $ftok = ftok($pathname, $proj);
        }
        else{
            
            $pathname = $pathname . (string) $proj;
            
            for($key = array(); sizeof($key) < strlen($pathname); $key[] = ord(substr($pathname, sizeof($key), 1)));
            
            $ftok = dechex(array_sum($key));
        }
        return $ftok;
}

print(custom_ftok(__FILE__, "dune1"));
$shm_id = shmop_open(0xff3, "c", 0644, 100);
if (!$shm_id) {
    echo "Couldn't create shared memory segment\n";
}

// Get shared memory block's size
$shm_size = shmop_size($shm_id);
echo "SHM Block Size: " . $shm_size . " has been created.\n";
sleep(10);

// Lets write a test string into shared memory
$shm_bytes_written = shmop_write($shm_id, "my shared memory block", 0);
if ($shm_bytes_written != strlen("my shared memory block")) {
    echo "Couldn't write the entire length of data\n";
}

// Now lets read the string back
$my_string = shmop_read($shm_id, 0, $shm_size);
if (!$my_string) {
    echo "Couldn't read from shared memory block\n";
}
echo "The data inside shared memory was: " . $my_string . "\n";

sleep(10);

//Now lets delete the block and close the shared memory segment
/*if (!shmop_delete($shm_id)) {
    echo "Couldn't mark shared memory block for deletion.";
}
shmop_close($shm_id);*/