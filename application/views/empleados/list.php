<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="container">
  <!-- Content here -->
  <img src="<?php echo base_url().'Assets/imgs/logo.png' ?>" alt="logo white" class="d-inline w-25 p-3 ">
  <h2 class="d-inline">InterwapTest</h2>

  
  </thead>
  <tbody>
    <?php
    
      
      foreach ($tipos as  $value) 
      {
        echo "<h4>tipo: ".$value['tipo']."</h4>";
        $i=0;
        echo '<table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">nombres</th>
            <th scope="col">apellidos</th>
            <th scope="col">correo</th>
          </tr>';
        foreach ($empleados[$value['id']-1] as $row) 
        {
          ++$i;
          echo "<tr>
                  <td>".$i."</td>
                  <td>".$row['nombres']."</td>
                  <td>".$row['apellidos']."</td>
                  <td>".$row['correo']."</td>
                  <td>
                    <a href='".base_url()."cempleados/edit/?id=".$row['id']."'   class='btn btn-info' >editar</a>
                    <a  id='".$row['id']."' class='btn btn-info  view_delete' data-toggle='modal' data-target='#exampleModal'>borrar</a>
                    
                  </td>
                </tr>";
        }

        echo " </tbody>
        </table>";
      }

      
		
		?>	
   <?php echo form_open('cempleados/delete'); ?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">borrar empleado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary deleteend" name="idend" >borrar!</button>
      </div>
    </div>
  </div>
</div>
<?php echo form_close();?>  
 
<!-- jQuery JS CDN -->
<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
<!-- Bootstrap JS CDN -->
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> 
<script type="text/javascript">
     // Start jQuery function after page is loaded
        $(document).ready(function()
        {
         
          
         // Start jQuery click function to view Bootstrap modal when view info button is clicked
            $('.view_delete').click(function(){
             // Get the id of selected phone and assign it in a variable called phoneData
             console.log("CLICK");
                var phoneData = $(this).attr('id');
                // Start AJAX function
                $.ajax({
                 // Path for controller function which fetches selected phone data
                    url: "<?php echo base_url() ?>cempleados/delete",
                    // Method of getting data
                    method: "POST",
                    // Data is sent to the server
                    data: {id:phoneData},
                    // Callback function that is executed after data is successfully sent and recieved
                    success: function(data){
                     // Print the fetched data of the selected phone in the section called #phone_result 
                     // within the Bootstrap modal
                     //console.log(JSON.parse(data));
                        $('.modal-body').html(JSON.parse(data)[0]);
                        // Display the Bootstrap modal
                        $('#exampleModal').modal('show');

                        $('.deleteend').attr('value', JSON.parse(data)[1]);
                    }
             });
             // End AJAX function
         });
     });  

  
</script>
</div>
