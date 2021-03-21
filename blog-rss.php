<?php 
    date_default_timezone_set('Asia/Tokyo');    
    $url = "https://itaboo.hatenablog.com/rss";
    $rss =  simplexml_load_file($url);
    $output = '';
    $i = 0;
    // 取得件数
    $max = 6;
    if($rss){
        foreach( $rss->channel->item as $item )
        {
            /**
            * タイトル
            * $item->title ;
            * リンク
            * $item->link ;
            * 更新日時のUNIX TIMESTAMP
            * $timestamp = strtotime( $item->pubDate ) ;
            * 詳細
            * $item->description;
             */
            if(!preg_match('/^PR:/',$item->title )){
                if($i < $max){
                    $timestamp = strtotime( $item->pubDate );
                    $date = date( 'Y.m.d',$timestamp );
                    $output .= '<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">';
                        $output .= '<div class="blog-box-outer">';
                            $output .= '<a href="'. $item->link .'" class="blog-box-inner" target="_blank">';
                                $output .= '<div class="date-box">';
                                    $output .= '<p class="date"><time datetime="' . $item->pubDate . '">' . $date . '</time></p>';
                                $output .= '</div>';
                                $output .= '<div class="title-box">';
                                    $output .= '<h6 class="title">' . $item->title . '</h6>';
                                $output .= '</div>';
                            $output .= '</a>';
                        $output .= '</div>';
                    $output .= '</div>';
                    $i++;
                }
            }
            
        }
    }
     
    echo '<div class="blog-boxs row">'. $output . '</div>';
?>