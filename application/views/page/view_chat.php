
<?php

                      foreach ($chat as $key => $v) {
                        # code...
                        if(!empty($v->namaguru)){
                          ?>
                           <!-- Message to the right -->
                          <div class="direct-chat-msg right">
                            <div class="direct-chat-infos clearfix">
                              <span class="direct-chat-name float-right"><?= substr($v->namaguru , 0, 10)?>...</span>
                              <span class="direct-chat-timestamp float-left"><?= $v->waktu ?></span>
                            </div>
                            <!-- /.direct-chat-infos -->
                            <img class="direct-chat-img bg-warning" src="<?= base_url().'assets/images/user.jpg' ?>" alt="message user image">
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text bg-warning" style="border:none;">
                              <?php
                            $p=array();
                              $text=explode(" ", $v->text);
                              for($i=0;$i<count($text)-1;$i++){
                                  if(substr($text[$i],0,1)=="@"){
                                      foreach ($siswa as $k => $val) {
                                          # code...
                                          if(substr($text[$i],1,strlen($text[$i])-1)==$val->nis){
                                            $text[$i]="<b>".$val->nama." </b>";
                                          }
                                      }
                                    
                                  }
                              }

                              $pesan=implode(" ",$text);

                              echo $pesan;
                            ?>
                            </div>
                            <!-- /.direct-chat-text -->
                          </div>
                          <!-- /.direct-chat-msg -->
                          <?php
                        }else{
                          ?>
                          <div class="direct-chat-msg">
                            <div class="direct-chat-infos clearfix">
                              <span class="direct-chat-name float-left" style="cursor: pointer;" onclick="balas('<?= $v->nis ?>');"><?= substr($v->namasiswa , 0, 10)?>...</span>
                              <span class="direct-chat-timestamp float-right"><?= $v->waktu ?></span>
                            </div>
                            <!-- /.direct-chat-infos -->
                            <img class="direct-chat-img" src="<?= base_url().'assets/images/user.jpg' ?>" alt="message user image">
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                              <?php
                            $p=array();
                              $text=explode(" ", $v->text);
                              for($i=0;$i<count($text)-1;$i++){
                                  if(substr($text[$i],0,1)=="@"){
                                      foreach ($siswa as $k => $val) {
                                          # code...
                                          if(substr($text[$i],1,strlen($text[$i])-1)==$val->nis){
                                            $text[$i]="<b>".$val->nama." </b>";
                                          }
                                      }
                                    
                                  }
                              }

                              $pesan=implode(" ",$text);

                              echo $pesan;
                            ?>
                            </div>
                            <!-- /.direct-chat-text -->
                        </div>
                          <?php
                        }
                      }
                      ?>