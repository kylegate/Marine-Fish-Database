<?php
class saltwaterfish {
    private int $saltwaterFishID;

    public function __construct(
        private string $Scientific_Name,
        private string $Common_Name,
        private int $Lifespan,
        private string $Behavior,
    ) { }

    public function getSaltwaterFishID() {
        return $this->saltwaterFishID;
    }

    public function getScientific_Name() {
        return $this->Scientific_Name;
    }

    public function getCommon_Name() {
        return $this->Common_Name;
    }

    public function getLifespan() {
        return $this->Lifespan;
    }

    public function getBehavior() {
        return $this->Behavior;
    }

    public function setsaltwaterFishID($saltwaterFishID) {
        $this->saltwaterFishID = $saltwaterFishID;
    }

    public function setScientific_Name($Scientific_Name) {
        $this->Scientific_Name = $Scientific_Name;
    }

    public function setCommon_Name($Common_Name) {
        $this->Common_Name = $Common_Name;
    }

    public function setLifespan($Lifespan) {
        $this->Lifespan = $Lifespan;
    }

    public function setBehavior($Behavior) {
        $this->Behavior = $Behavior;
    }
}
?>