

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12"> 
                <hr>
                    <p style="font-family: 'Open Sans Condensed', sans-serif;  font-size: 12pt;">Copyright Einkaufszettel</p>
                </div>
                <div class="col-lg-12" style="text-align:right;"> 
                <?php 
					if(!isset($_SESSION['username']) == _getUsername($_SESSION['username'])) 
  					 { 
                    echo "<p style=\"
    top: -30px;
    position: relative;\"><a href=\"page.php?p=Login\" title=\"Login\">Login</a></p>";
					 }else{
					echo "<p  style=\"
    top: -30px;
    position: relative;\"><a href=\"page.php?p=Login\" title=\"Login\">Logout</a></p>";
					 }
					 ?>
                </div>
            </div>
        </footer>
        
            </div>
    <!-- /.container -->

    <!-- jQuery -->
    
	<script src="js/jquery.js" type="text/javascript"></script>
		
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

   <script>$(function () {
    $('.list-group.checked-list-box .list-group-item').each(function () {
        
        // Settings
        var $widget = $(this),
            $checkbox = $('<input type="checkbox" class="hidden" />'),
            color = ($widget.data('color') ? $widget.data('color') : "primary"),
            style = ($widget.data('style') == "button" ? "btn-" : "list-group-item-"),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };
            
        $widget.css('cursor', 'pointer')
        $widget.append($checkbox);

        // Event Handlers
        $widget.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });
          

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $widget.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $widget.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$widget.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $widget.addClass(style + color + ' active');
            } else {
                $widget.removeClass(style + color + ' active');
            }
        }

        // Initialization
        function init() {
            
            if ($widget.data('checked') == true) {
                $checkbox.prop('checked', !$checkbox.is(':checked'));
            }
            
            updateDisplay();

            // Inject the icon if applicable
            if ($widget.find('.state-icon').length == 0) {
                $widget.prepend('<span class="state-icon ' + settings[$widget.data('state')].icon + '"></span>');
            }
        }
        init();
    });
    
    $('#get-checked-data').on('click', function(event) {
        event.preventDefault(); 
        var checkedItems = {}, counter = 0;
        $("#check-list-box li.active").each(function(idx, li) {
            checkedItems[counter] = $(li).text();
            counter++;
        });
        $('#display-json').html(JSON.stringify(checkedItems, null, '\t'));
    });
});</script>

    </body>

</html>