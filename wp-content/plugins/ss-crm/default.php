<?php 
class List_Table extends WP_List_Table {
	
  public  $example_data = array(
			array(
					'ID'        => 1,
					'title'     => '300',
					'rating'    => 'R',
					'director'  => 'Zach Snyder'
			),
			array(
					'ID'        => 2,
					'title'     => 'Eyes Wide Shut',
					'rating'    => 'R',
					'director'  => 'Stanley Kubrick'
			),
			array(
					'ID'        => 3,
					'title'     => 'Moulin Rouge!',
					'rating'    => 'PG-13',
					'director'  => 'Baz Luhrman'
			),
			array(
					'ID'        => 4,
					'title'     => 'Snow White',
					'rating'    => 'G',
					'director'  => 'Walt Disney'
			),
			array(
					'ID'        => 5,
					'title'     => 'Super 8',
					'rating'    => 'PG-13',
					'director'  => 'JJ Abrams'
			),
			array(
					'ID'        => 6,
					'title'     => 'The Fountain',
					'rating'    => 'PG-13',
					'director'  => 'Darren Aronofsky'
			),
			array(
					'ID'        => 7,
					'title'     => 'Watchmen',
					'rating'    => 'R',
					'director'  => 'Zach Snyder'
			)
	);
	
   function __construct(){
	  	global $status, $page;
	  	parent::__construct( array(
	  			'singular'  => 'movie',     //singular name of the listed records
	  			'plural'    => 'movies',    //plural name of the listed records
	  			'ajax'      => false        //does this table support ajax?
	  	) );
	  
	}
	
	function column_default($item, $column_name){
		switch($column_name){
			case 'rating':
			case 'director':
				return $item[$column_name];
			default:
				return print_r($item,true); //Show the whole array for troubleshooting purposes
		}
	}
	
	function column_title($item){
	
		//Build row actions
		$actions = array(
				'edit'      => sprintf('<a href="?page=%s&action=%s&movie=%s">Edit</a>',$_REQUEST['page'],'edit',$item['ID']),
				'delete'    => sprintf('<a href="?page=%s&action=%s&movie=%s">Delete</a>',$_REQUEST['page'],'delete',$item['ID']),
		);
	
		//Return the title contents
		return sprintf('%1$s <span style="color:silver">(id:%2$s)</span>%3$s',
				/*$1%s*/ $item['title'],
				/*$2%s*/ $item['ID'],
				/*$3%s*/ $this->row_actions($actions)
		);
	}
	
	function column_cb($item){
		return sprintf(
				'<input type="checkbox" name="%1$s[]" value="%2$s" />',
				/*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
				/*$2%s*/ $item['ID']                //The value of the checkbox should be the record's id
		);
	}
	
	function get_columns(){
		$columns = array(
				'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
				'title'     => '客户名称',
				'rating'    => '联系方式',
				'director'  => '地址',
				'director2'  => '地址2'
		);
		return $columns;
	}
	
	function get_sortable_columns() {
		$sortable_columns = array(
				'title'     => array('title',false),     //true means it's already sorted
				'rating'    => array('rating',false),
				'director'  => array('director',false)
		);
		return $sortable_columns;
	}
	
	function get_bulk_actions() {
		$actions = array(
				'delete'    => 'Delete'
		);
		return $actions;
	}
	
	function process_bulk_action() {
	
		//Detect when a bulk action is being triggered...
		if( 'delete'===$this->current_action() ) {
			wp_die('Items deleted (or they would be if we had items to delete)!');
		}
	
	}
	
	function prepare_items() {
		global $wpdb; //This is used only if making any database queries
	
		/**
		 * First, lets decide how many records per page to show
		 */
		$per_page = 5;
	
	
		/**
		 * REQUIRED. Now we need to define our column headers. This includes a complete
		 * array of columns to be displayed (slugs & titles), a list of columns
		 * to keep hidden, and a list of columns that are sortable. Each of these
		 * can be defined in another method (as we've done here) before being
		 * used to build the value for our _column_headers property.
		 */
		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();
	
	
		/**
		 * REQUIRED. Finally, we build an array to be used by the class for column
		 * headers. The $this->_column_headers property takes an array which contains
		 * 3 other arrays. One for all columns, one for hidden columns, and one
		 * for sortable columns.
		*/
		$this->_column_headers = array($columns, $hidden, $sortable);
	
	
		/**
		 * Optional. You can handle your bulk actions however you see fit. In this
		 * case, we'll handle them within our package just to keep things clean.
		*/
		$this->process_bulk_action();
	
	
		/**
		 * Instead of querying a database, we're going to fetch the example data
		 * property we created for use in this plugin. This makes this example
		 * package slightly different than one you might build on your own. In
		 * this example, we'll be using array manipulation to sort and paginate
		 * our data. In a real-world implementation, you will probably want to
		 * use sort and pagination data to build a custom query instead, as you'll
		 * be able to use your precisely-queried data immediately.
		*/
		$data = $this->example_data;
	
	
		/**
		 * This checks for sorting input and sorts the data in our array accordingly.
		 *
		 * In a real-world situation involving a database, you would probably want
		 * to handle sorting by passing the 'orderby' and 'order' values directly
		 * to a custom query. The returned data will be pre-sorted, and this array
		 * sorting technique would be unnecessary.
		 */
		function usort_reorder($a,$b){
			$orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'title'; //If no sort, default to title
			$order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'asc'; //If no order, default to asc
			$result = strcmp($a[$orderby], $b[$orderby]); //Determine sort order
			return ($order==='asc') ? $result : -$result; //Send final sort direction to usort
		}
		usort($data, 'usort_reorder');
	
	
		/***********************************************************************
		 * ---------------------------------------------------------------------
		* vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
		*
		* In a real-world situation, this is where you would place your query.
		*
		* ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
		* ---------------------------------------------------------------------
		**********************************************************************/
	
	
		/**
		 * REQUIRED for pagination. Let's figure out what page the user is currently
		 * looking at. We'll need this later, so you should always include it in
		 * your own package classes.
		*/
		$current_page = $this->get_pagenum();
	
		/**
		 * REQUIRED for pagination. Let's check how many items are in our data array.
		 * In real-world use, this would be the total number of items in your database,
		 * without filtering. We'll need this later, so you should always include it
		 * in your own package classes.
		*/
		$total_items = count($data);
	
	
		/**
		 * The WP_List_Table class does not handle pagination for us, so we need
		 * to ensure that the data is trimmed to only the current page. We can use
		 * array_slice() to
		*/
		$data = array_slice($data,(($current_page-1)*$per_page),$per_page);
	
	
	
		/**
		 * REQUIRED. Now we can add our *sorted* data to the items property, where
		 * it can be used by the rest of the class.
		*/
		$this->items = $data;
	
	
		/**
		 * REQUIRED. We also have to register our pagination options & calculations.
		 */
		$this->set_pagination_args( array(
				'total_items' => $total_items,                  //WE have to calculate the total number of items
				'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
				'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
		) );
	}
	
}

//Create an instance of our package class...
$testListTable = new List_Table();
//Fetch, prepare, sort, and filter our data...
$testListTable->prepare_items();

?>

    <div class="wrap">
        
        <div id="icon-users" class="icon32"><br/></div>
        <h2>List Table Test</h2>
        
        <div style="background:#ECECEC;border:1px solid #CCC;padding:0 10px;margin-top:5px;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;">
            <p>demonstrates the use of the </p>
        </div>
        
        <!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
        <form id="movies-filter" method="get">
            <!-- For plugins, we also need to ensure that the form posts back to our current page -->
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <!-- Now we can render the completed list table -->
            <?php $testListTable->display() ?>
        </form>
        
    </div>