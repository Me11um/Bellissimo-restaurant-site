
<?php 

    require "cookies.php";
    //require "rb.php";
    //R::setup( 'mysql:host=localhost; dbname=f0756907_DB', 'f0756907_DB', 'Zuma8268' );
    
    $cookie_key = 'online-cache';
    $ip = $_SERVER['REMOTE_ADDR'];
    $online = R::findOne('online', 'ip = ?', array($ip));
    
    if ( $online )
    {
        $do_update = false;
        //update
        if ( CookieManager::stored($cookie_key) )
        {
            //Via cookies
            $c = (array) @json_decode(CookieManager::read($cookie_key), true);
            if ( $c )
            {
                if ($c['lastvisit'] < (time() - (60)))
                {
                    $do_update = true;
                }
            }
            else
            {
                //Without cookies
                $do_update = true;
            }
        }
        else
        {
            //Without cookies
            $do_update = true;
        }
        
        //Update if required
        if ( $do_update )
        {
            $time = time();
            $online->lastvisit = $time;
            R::store($online);
            CookieManager::store($cookie_key, json_encode(array(
                'id' => $online->id,
                'lastvisit' => $time)));
        }
    } else {
        // Create
        $time = time();
        $online = R::dispense('online');
        $online->lastvisit = $time;
        $online->ip = $ip;
        R::store($online);
        CookieManager::store($cookie_key, json_encode(array(
            'id' => $online->id,
            'lastvisit' => $time)));
    }
    
    $online_count = R::count('online', "lastvisit > " . ( time() - (300) ));
    
    
    
    echo $online_count;
?>