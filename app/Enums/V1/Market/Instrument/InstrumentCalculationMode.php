<?php

namespace App\Enums\V1\Market\Instrument;

use App\Enums\V1\EnumTrait;

abstract class InstrumentCalculationMode
{
    use EnumTrait;

    const FOREX = 12500;
    const FOREX_NO_LEVERAGE = 12501;
    const FUTURES = 12502;
    const CFD = 12503;
    const CFD_INDEX = 12504;
    const CFD_LEVERAGE = 12505;
    const EXCH_STOCKS = 12506;
    const EXCH_FUTURES = 12507;
    const EXCH_FUTURES_FORTS = 12508;
    const EXCH_BONDS = 12509;
    const EXCH_STOCKS_MOEX = 12510;
    const EXCH_BONDS_MOEX = 12511;
    const SERV_COLLATERAL = 12512;
}
