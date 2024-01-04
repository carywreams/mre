<?php

class MatchboxIterable
	implements Iterator {

	private int $count_of_matchbox_types = 0;
	private array $matchbox_type = [];
	private array $matchbox = [];

	public function __construct(pdflib $p) {
		// builds an overview
		$this->count_of_matchbox_types = $p->info_matchbox('*',0,'count');
		for ($i = 1; $i<=$this->count_of_matchbox_types; $i++) {
			$matchbox_name_id = $p->info_matchbox('*',$i,'name');
			$matchbox_name = $p->get_string($matchbox_name_id,'');
			$count_this_matchbox_name = $p->info_matchbox($matchbox_name, 0, 'count');
			$this->matchbox_type[] = ['name'=>$matchbox_name,'count'=>$count_this_matchbox_name];
		}

		// now grab the details for each one of each type
		for ($i = 0; $i<sizeof($this->matchbox_type); $i++) {
			for ($mb = 1; $mb<=$this->matchbox_type[$i]['count']; $mb++) {
				$mbtype_name = $this->matchbox_type[$i]['name'];
				$this->matchbox[] = [
					'name'   => $mbtype_name,
					'id'     => $mb,
					'x1'	 => $p->info_matchbox($mbtype_name, $mb, "x1"),
					'y1'	 => $p->info_matchbox($mbtype_name, $mb, "y1"),
					'width'	 => $p->info_matchbox($mbtype_name, $mb, "width"),
					'height' => $p->info_matchbox($mbtype_name, $mb, "height"),
					'fieldname' => sprintf('_fn%s%03d',$mbtype_name,$mb)
				];
			}
		}

		//die(print_r([$this->matchbox_type,$this->matchbox],true));
	}

	private int $posn = 0;
	public function current(): mixed { return (object) $this->matchbox[$this->posn]; }
	public function key(): mixed {return $this->posn;}
	public function next(): void {$this->posn++;}
	public function rewind(): void {$this->posn = 0;}
	public function valid(): bool {return ($this->posn < sizeof($this->matchbox));}
}
