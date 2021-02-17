<?php
class HotelLoader
{
  private const TOP_HOTELS_AMOUNT = 3;
  public $hotels;
  public $average_score;

  function __construct($hotels)
  {
    // Removing hotels with no score
    $this->hotels = array_filter($hotels, fn ($hotel) => $hotel['score'] !== '');
    $this->setAverageScore();
    $this->sortHotels();
  }

  public function topHotels()
  {
    return array_slice($this->hotels, 0, self::TOP_HOTELS_AMOUNT);
  }

  private function setAverageScore()
  {
    if ($this->hotels) {
      $sum = 0;
      foreach ($this->hotels as $hotel) {
        $sum += $hotel['score'];
      }
      $this->average_score = $sum / count($this->hotels);
    }
  }

  private function sortHotels()
  {
    usort($this->hotels, fn ($a, $b) => $b['score'] <=> $a['score']);
  }
}
