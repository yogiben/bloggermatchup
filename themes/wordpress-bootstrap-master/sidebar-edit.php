				<div id="blogger-edit-sidebar" class="fluid-sidebar sidebar span4" role="complementary">
				
                    
                    <?php 
                    
                    $ID = $post->ID;

                    $args = array(
                        'child_of' => 20
                    ); 
                    
                    $pages = get_pages($args);

                    echo '<ul class="nav nav-list">';
                    echo '<li class="nav-header">Your Profile</li>';


                    foreach ($pages as $page)
                    {
                        echo '<li>';
                            echo '<a href="';
                            echo get_permalink($page -> ID);
                            echo '"';
                            
                            echo ' class="';
                            
                            if ($ID == $page -> ID){
                                
                                echo 'active selected';
                                
                            }
                            
                            echo '"';
                            
                            echo '>';
                            echo get_the_title($page);
                            echo '</a>';
                        echo '</li>';
                    }

                    echo '</ul>';
                    ?>
                    

				</div>