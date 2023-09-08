<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <section class="shadow p-3 bg-orange rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
            </section>
        </div>
        <div class="col-6">

            <section class="shadow p-3  rounded" style="margin-bottom: 15px;margin-left: 20px;margin-right: 20px;">
           
           
            
            
                <div class="card card-danger direct-chat direct-chat-danger collapsed-card">
                    <div class="card-header">

                        <h3 class="card-title">Direct Chat</h3>

                        <div class="card-tools">

                            <span data-toggle="tooltip" title="3 New Messages" class="badge badge-light">3</span>

                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>



                        </div>
                    </div>
                    
                    <div class="card-body">
                        
                        <div class="direct-chat-messages">


                        
                        
                        </div>
                    </div>
                </div>

                <div class="card card-danger direct-chat direct-chat-danger">
                    <div class="card-header">

                        <h3 class="card-title">Direct Chat</h3>

                        <div class="card-tools">

                            <span data-toggle="tooltip" title="3 New Messages" class="badge badge-light">3</span>

                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>



                        </div>
                    </div>
                    
                    <div class="card-body">
                        
                        <div class="direct-chat-messages">


                        <?php for ($i=0; $i < 30; $i++) { ?>
                        llll <br>
                        <?php } ?>
                        
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </div>
</div>


<script>
    document.write('  @foreach($omologados as'+
    '$omologado){{$omologado->id}}<br> @endforeach');

</script>