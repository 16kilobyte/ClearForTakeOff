<?php

/**
 *
 */
class Search_Model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function suggest()
    {
        if(isset($_POST["suggestfor"]) && !empty($_POST["suggestfor"]))
        {
			$q = strip_tags(trim($_POST["suggestfor"]));
			$keywords = explode(" ", $q);
			$num = count($keywords);

			$words_condition = array();
			$words_condition2 = array();

			$args = array();
			$i=1;
			foreach($keywords as $keyword) {
				$words_condition[] = "name LIKE :kw{$i}";
				$words_condition2[] = "cityName LIKE :kw{$i}";
				$args[":kw{$i}"] = "%{$keyword}%";
				$i++;
			}
			$sql = "SELECT code, name, cityCode, cityName, countryName FROM airports WHERE ".implode(" OR ",$words_condition)." OR ".implode(" OR ",$words_condition2);
			$query = $this->db->prepare($sql);
			$query->execute($args);
			$results = $query->fetchAll(PDO::FETCH_ASSOC);
            $count = count($results);
			$disp = <<<KATOR
			<ul id="result">
KATOR;
			if($count>0) {
				$i = 1;
				foreach($results as $result) {
					$disp .= <<<KATOR

KATOR;
						$disp .= "<li class=\"hoverable clearfix\">
                            <a href=\"#\" title=\"{$result["name"]}\" >
                            <div class=\"result-body clearfix\">
									<div class=\"header\">
										<span>{$result["name"]}</span>,  {$result["cityName"]}</span>
										<small class=\"pull-right text-muted\">
											<i class=\"fa fa-plane\"></i>
										</small>
									</div>
								</div>
							</a></li>";
					$i++;
				}
			} else {
				$disp .= <<<KATOR
				<li class="no_result">
					Your search for <strong>{$q}</strong> returned no results
				</li>
KATOR;
			}
			$disp .= <<<KATOR
			</ul>
KATOR;
			echo $disp;
		}
    }
}
