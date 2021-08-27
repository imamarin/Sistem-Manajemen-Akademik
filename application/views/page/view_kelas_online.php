 <div class="content-wrapper">
 <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row" style="padding-top: 1%;">
        	<section class="col-lg-9 connectedSortable float-left" style="width: 100%;" >
        		<div class="card direct-chat direct-chat-primary" style="width: 100%;">
	              <div class="card-header">
	                <h3 class="card-title"><?= $judul." ".$kelas ?></h3>

	                <div class="card-tools">
	                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
	                    <i class="fas fa-minus"></i>
	                  </button>
	                </div>
	              </div>
	              <div class="card-body" style="padding: 2%;">
	              	<?= htmlspecialchars_decode($deskripsi) ?>
	              </div>
	          </div>
	          <div class="card direct-chat direct-chat-primary" style="width: 100%;">
	              <div class="card-header">
	                <h3 class="card-title">File Tambahan</h3>

	                <div class="card-tools">
	                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
	                    <i class="fas fa-minus"></i>
	                  </button>
	                </div>
	              </div>
	              <div class="card-body" style="padding: 2%;">
	              	<ul style="list-style:none;">
                            <?php 
                            if(!empty($file)):
                                $n=1; 
                                foreach($file as $f): 
                            ?>
                            <li style="float:left;margin-left:5%;">
                                <?php
                                $tipe=explode(".",$f->file);
                                $file=strtolower($tipe[count($tipe)-1]);
                                if($file=="jpg" || $file=="png" || $file=="gif"|| $file=="jpeg"){
                                ?>
                                <img src="<?php echo base_url('uploads/files/'.$f->file); ?>" alt="" style="width:100px;height:100px;">
                                <?php
                                }else if($file=="pdf"){
                                        ?>
                                        <img src="<?php echo base_url('uploads/files/imgpdf.png'); ?>" alt="" style="width:100px;height:100px;">
                                        <?php
                                }else if($file=="docx" || $file=="doc"){
                                        ?>
                                        <img src="<?php echo base_url('uploads/files/imgword.png'); ?>" alt="" style="width:100px;height:100px;">
                                        <?php
                                }else if($file=="pptx" || $file=="ppt"){
                                        ?>
                                        <img src="<?php echo base_url('uploads/files/imgppt.png'); ?>" alt="" style="width:100px;height:100px;">
                                        <?php
                                }else if($file=="mp4"){
                                    ?>
                                    <img src="<?php echo base_url('uploads/files/img_vid.png'); ?>" alt="" style="width:100px;height:100px;">
                                    <?php
                                }
                                ?>
                                <p style="margin-top:10%;"> <?= "FILE".$n; ?>, 
                                <a href="<?= base_url().'guru/materi/modulview/'.$f->file ?>">View</a>
                                <a href="<?= base_url().'guru/materi/hapusmodul/'.$f->idtugas.'/'.$f->idmodul ?>">Hapus</a></p>
                            </li>
                            <?php 
                                $n++;
                                endforeach; 
                            else: ?>
                            <p>No File uploaded.....</p>
                            <?php 
                            
                            endif; ?>
                        </ul>
	              </div>
	          </div>
        	</section>

	         <section class="col-lg-3 connectedSortable ">
	          	<div class="row">
	          		<section class="col-lg-12 connectedSortable ">
		          	<!-- DIRECT CHAT -->
		            <div class="card direct-chat direct-chat-primary" style="width: 100%;">
		              <div class="card-header">
		                <h3 class="card-title">Ruang Chat</h3>

		                <div class="card-tools">
		                  <span data-toggle="tooltip" title="3 New Messages" class="badge badge-primary"></span>
		                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
		                    <i class="fas fa-minus"></i>
		                  </button>
		                </div>
		              </div>
		              <!-- /.card-header -->
		              <div class="card-body">
		                <!-- Conversations are loaded here -->
		                <div class="direct-chat-messages" id="vChat" onwheel="myScript1()">
		                  <!-- Message. Default to the left -->
		                  
		               	                  
		                </div>
		                <div class="modal fade" id="modal-lg">
					        <div class="modal-dialog modal-lg">
					          <div class="modal-content">
					            <div class="modal-header">
					              <h4 class="modal-title">Komentar</h4>
					              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                <span aria-hidden="true">&times;</span>
					              </button>
					            </div>
					            <div class="modal-body">
					            	<div class="direct-chat-messages" id="vChat2" onwheel="myScript2()">
							                  <!-- Message. Default to the left -->
							                <div class="direct-chat-msg" >
					              				<p>Menunggu Pesan</p>
					          				</div>
					          			</div>
					            </div>
					            <div class="modal-footer justify-content-between">
					              <input type="text" id="pesan" class="form-control">
					              <button type="button" class="btn btn-primary" onclick="addChat('<?= $idtugas ?>','<?= $kdkelas ?>');">Kirim</button>
					            </div>
					          </div>
					          <!-- /.modal-content -->
					        </div>
					        <!-- /.modal-dialog -->
					      </div>
		                <!--/.direct-chat-messages-->
		              <!-- /.card-body -->
		              <div class="card-footer">
		                <form action="#" method="post">
		                  <div class="input-group">
		                  	<button type="button" class="btn btn-primary" style="width: 100%;"  data-toggle="modal" data-target="#modal-lg">
			                  Komentar
			                </button>
		                      <!--<button type="button" class="btn btn-primary" style="width: 100%;" onclick="addChat('<?= $idtugas ?>','<?= $kdkelas ?>');">Komentar</button>-->
		                  </div>
		                </form>
		              </div>
		              <!--
		              <div class="card-footer">
		                <form action="#" method="post">
		                  <div class="input-group">
		                  	<input type="text" id="pesan" placeholder="Type Message ..." class="form-control">
		                    
		                    <span class="input-group-append">
		                      <button type="button" class="btn btn-primary" onclick="addChat('<?= $idtugas ?>','<?= $kdkelas ?>');">Send</button>
		                    </span>
		                  </div>
		                </form>
		              </div>
		          		-->
		              <!-- /.card-footer-->
		            </div>
	            <!--/.direct-chat -->
	        		</div>
	        	</section>
	        	<section class="col-lg-12 ">
	          	<!-- DIRECT CHAT -->
		            <div class="card direct-chat direct-chat-primary" style="width: 100%;">
		              <div class="card-header">
		                <h3 class="card-title">Kehadiran Siswa</h3>

		                <div class="card-tools">
		                  <span data-toggle="tooltip" title="3 New Messages" class="badge badge-primary"></span>
		                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
		                    <i class="fas fa-minus"></i>
		                  </button>
		                </div>
		              </div>
		              <!-- /.card-header -->
		              <div class="card-body">
		                <!-- Conversations are loaded here -->
		                <div class="direct-chat-messages">
		                  <!-- Message. Default to the left -->
		                  <div class="direct-chat-msg" id="vlog" >
		                    
		                    <!-- /.direct-chat-text -->
		                  </div>
		                  <!-- /.direct-chat-msg -->
		                </div>
		                <!--/.direct-chat-messages-->
		              <!-- /.card-body -->
		              <!-- /.card-footer-->
		            </div>
		        </div>
		    </section>
		</div>
	            <!--/.direct-chat -->
	    </section>
    </div>
</div>
</section>
</div>

	
<script>
	var mulai=0;
	var mulai2=0;
	sendLog();
    function sendLog() {
      $.post("<?= base_url().'guru/home/logmasukchat' ?>",{
        kelas:"<?= $kelas ?>",
		idtugas:"<?= $idtugas ?>",
		idtahun:"<?= $idthn ?>"
      },
        function(data, status){
          //alert(data);
          document.getElementById("vlog").innerHTML=data;
        }
      );
    }
    /*
    setInterval(function () {
        sendLog();
    }, 60000);
	*/
    function addChat(idtgs,kdkls) {
    	//alert(idtgs);
	    $.post("<?= base_url().'guru/kelasonline/add' ?>",{
	        pesan:document.getElementById('pesan').value,
	        idtugas:idtgs,
	        kdkelas:kdkls,
	        thnajaran:'2'
	    },
	        function(data, status){
	        	mulai2=0;
	        	document.getElementById('pesan').value='';
	        }
	    );


	    
    }

    function myScript1(){
    	mulai=1;
    }

    function myScript2(){
    	mulai2=1;
    }
    
    function viewChat() {
      $("#vChat").mousedown(function(){
	    mulai=1;
	  });

	  $("#vChat2").mousedown(function(){
	    mulai2=1;
	  });

      if(mulai==0){
      	var objDiv = document.getElementById("vChat");
	  	objDiv.scrollTop = objDiv.scrollHeight;		
      }

      if(mulai2==0){
      	var objDiv2 = document.getElementById("vChat2");
      	objDiv2.scrollTop = objDiv2.scrollHeight;
      }

      $.post("<?= base_url().'guru/kelasonline/viewChat' ?>",{
        kdkelas:"<?= $kdkelas ?>",
        idtugas:"<?= $idtugas ?>",
        idtahun:"<?= $idthn ?>",
      },
        function(data, status){
          //alert(data);
          document.getElementById("vChat").innerHTML=data;
          document.getElementById("vChat2").innerHTML=data;
        }
      );
    }
    
    setInterval(function () {
        viewChat();
    }, 1500);

    function balas($n){
    	document.getElementById('pesan').value=document.getElementById('pesan').value+"@"+$n+" ";
    	document.getElementById('pesan').focus();
    }
</script>