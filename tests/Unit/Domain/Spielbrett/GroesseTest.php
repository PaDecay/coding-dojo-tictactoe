<?php
declare(strict_types=1);

namespace App\Tests\Unit\Domain\Spielbrett;


use App\Domain\Spielbrett\Groesse;
use PHPUnit\Framework\TestCase;

final class GroesseTest extends TestCase
{
    private Groesse $groesse;

   public function setUp(): void
   {
       $this->groesse = new Groesse(4, 7);
   }

    public function testKannGroesseMitHoeheUndBreiteErstellen(): void
   {
       self::assertTrue($this->groesse instanceof Groesse); // Sinnvoll wenn es kein named constructor ist?
       self::assertEquals(4, $this->groesse->hoehe());      //soll das hier nochmal getestet werden?
       self::assertEquals(7, $this->groesse->breite());
   }

   public function testKannAufBreiteZugreifen(): void
   {
       self::assertEquals(7, $this->groesse->breite());
   }

   public function testKannAufHoeheZugreifen(): void
   {
       self::assertEquals(4, $this->groesse->hoehe());
   }

   public function testXKoordinateBefindetSichInnerhalbDerGueltigenBreite(): void
   {
       self::assertTrue($this->groesse->gueltigeXKoordinate(4));
   }

   public function testYKoordinateBefindetSichInnerhalbDerGueltigenHoehe(): void
   {
       self::assertTrue($this->groesse->gueltigeYKoordinate(2));
   }
}