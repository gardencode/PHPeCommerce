<?php
/*
	Created by Mike
	Based on Cainton's model and some of Glen's ideas
	
	This class manages a list of products
	
	Usage is
		1) create model
		2) set filters
		3) get product list
	
	Filters can be set for
		category id
		word match in name
		price range (or just min or max price)
		limit (and offset) for rows returned
			... this allows paging through products
			
			
	Note that a search can be refined by setting additional filters and retrieving
    the product list again	
*/

class ProductsModel extends AbstractModel {

    private $products;
    private $constraints;
	private $limit;

    public function __construct($db) {
        parent::__construct($db);
        $this->products = null;
		$this->constraints = array();
		$limit=null;
	}
	
	public function setCategoryFilter ($categoryId) {
		if (!ctype_digit($categoryId)) {
			throw new InvalidDataException('Invalid category ID');
		}
		$this->constraints[]="categoryId = $categoryId";
		$this->products=null;
	}
	
	public function setNameMatch ($text) {
		$safeText = $this->getDB()->escape($text);
		$this->constraints[]="name like '%$safeText%'";
		$this->products=null;
	}

	public function setPriceRange ($minimum=null, $maximum=null) {
		if ($minimum === null && $maximum === null) {
			return;
		}
		if ($minimum !==null && !is_numeric ($minimum)) {
			throw new InvalidDataException('Invalid minimum value');
		}
		if ($maximum !==null && !is_numeric ($maximum)) {
			throw new InvalidDataException('Invalid maximum value');
		}
		if ($minimum !==null && $maximum !== null) {
			$this->constraints[]="price between $minimum and $maximum";
		} else if ($minimum !==null) {
			$this->constraints[]="price >= $minimum";
		} else {
			$this->constraints[]="price <= $maximum";
		}
		$this->products=null;
	}

	public function setLimit ($limit, $offset=null) {
		if (!is_numeric ($limit)) {
			throw new InvalidDataException('Invalid limit value');
		}
		if ($offset !==null && !is_numeric ($offset)) {
			throw new InvalidDataException('Invalid offset value');
		}
		if ($offset === null ) {
			$this->limit = " LIMIT $limit";
		} else {
			$this->limit = " LIMIT $limit OFFSET $offset";
		}
		$this->products=null;
	}
	
    public function getProducts() {
		if ($this->products===null) {
			$this->products = array();
			$this->load();
		}
        return $this->products;
    }

    private function load() {
        $sql = "select id, categoryId, name, description, price, image from product";
		if (count($this->constraints) > 0) {
			$sql .= $this->whereClause();
		}
		$sql .= " order by name asc";
		if ($this->limit !==null) {
			$sql .= $this->limit;
		}
        $rows = $this->getDB()->query($sql);
        foreach ($rows as $row){
            $productId = $row['id'];
            $categoryId = $row['categoryId'];
            $productName = $row ['name'];
            $productDescription = $row ['description'];
            $productPrice = $row ['price'];
            $productImage = $row ['image'];
            $product = ProductModel::createFromFields($this->getDB(),$productId,$categoryId,$productName,$productDescription,$productPrice,$productImage);
            $this->products[]=$product;
        }
    }
	private function whereClause() {
		return ' where (' . implode (') AND (',$this->constraints).')';
	}
}
?>