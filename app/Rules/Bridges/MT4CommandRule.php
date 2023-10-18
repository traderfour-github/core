<?php

namespace App\Rules\Bridges;

use Illuminate\Contracts\Validation\Rule;

class MT4CommandRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $mt4_commands = [
            'AccountBalance' , 'AccountCompany' , 'AccountCredit' , 'AccountCurrency', 'AccountEquity' , 'AccountFreeMargin' ,
            'AccountFreeMarginCheck' , 'AccountFreeMarginMode' , 'AccountInfoDouble' , 'AccountInfoInteger' ,'AccountInfoString' ,
            'AccountLeverage', 'AccountMargin' , 'AccountName' , 'AccountNumber' ,'AccountProfit' ,'AccountServer' ,'AccountStopoutLevel' ,
            'AccountStopoutMode','acos','Alert','Alert','ArrayCompare','ArrayCopy','ArrayCopyRates','ArrayCopySeries','ArrayDimension','ArrayFill',
            'ArrayFree','ArrayGetAsSeries','ArrayInitialize','ArrayIsDynamic','ArrayIsSeries','ArrayMaximum','ArrayMinimum','ArrayRange',
            'ArrayResize','ArraySetAsSeries','ArraySize','ArraySort','asin','atan','Bars','ceil','CharArrayToString','ChartApplyTemplate',
            'ChartClose','ChartFirst','ChartGetDouble','ChartGetInteger','ChartGetString','ChartID','ChartIndicatorDelete','ChartIndicatorName',
            'ChartIndicatorsTotal','ChartNavigate','ChartNext','ChartOpen','CharToStr','CharToString','ChartPeriod','ChartPriceOnDropped',
            'ChartRedraw','ChartSaveTemplate','ChartScreenShot','ChartSetDouble','ChartSetInteger','ChartSetString','ChartSetSymbolPeriod',
            'ChartSymbol','ChartTimeOnDropped','ChartTimePriceToXY','ChartWindowFind','ChartWindowOnDropped','ChartXOnDropped','ChartXYToTimePrice',
            'ChartYOnDropped','CheckPointer','ColorToARGB','ColorToString','Comment','CopyClose','CopyHigh','CopyLow','CopyOpen','CopyRates',
            'CopyTickVolume','CopyTime','cos','CryptDecode','CryptEncode','Day','DayOfWeek','DayOfYear','DebugBreak','Digits','DoubleToStr',
            'DoubleToString','EnumToString','EventChartCustom','EventKillTimer','EventSetMillisecondTimer','EventSetTimer','exp','ExpertRemove',
            'fabs','FileClose','FileCopy','FileDelete,','FileFindClose','FileFindFirst','FileFindNext','FileFlush','FileGetInteger','FileIsEnding',
            'FileIsExist','FileIsLineEnding','FileMove','FileOpen','FileOpenHistory','FileReadArray','FileReadBool','FileReadDatetime','FileReadDouble',
            'FileReadFloat','FileReadInteger','FileWriteLong','FileWriteString','FileWriteStruct','floor','fmax','fmin','fmod','FolderClean','FolderCreate',
            'FolderDelete','GetLastError','GetPointer','GetTickCount','GlobalVariableCheck','GlobalVariableDel','GlobalVariableGet','GlobalVariableName',
            'GlobalVariablesDeleteAll','GlobalVariableSet','GlobalVariableSetOnCondition','GlobalVariablesFlush','GlobalVariablesTotal','GlobalVariableTemp',
            'HideTestIndicators','Hour','iAC','iAD','iADX','Alligator','iAO','iATR','iBands','iBandsOnArray','iBars','iBarShift','iBearsPower','iBullsPower',
            'iBWMFI','iCCI','iCCIOnArray','iClose','iCustom','iDeMarker','iEnvelopes','iEnvelopesOnArray','iForce','iFractals','iGator','iHigh','iHighest',
            'iIchimoku','iLow','iLowest','iMA','iMACD','iMAOnArray','iMFI','iMomentum','iMomentumOnArray','IndicatorBuffers','IndicatorCounted','IndicatorDigits',
            'IndicatorSetDouble','IndicatorSetInteger','IndicatorSetString','IndicatorShortName','IntegerToString','iOBV','iOpen'.'iOsMA','iRSI','iRSIOnArray',
            'iRVI','iSAR','IsConnected','IsDemo','IsDllsAllowed','IsExpertEnabled','IsLibrariesAllowed','IsOptimization','IsStopped','iStdDev','iStdDevOnArray',
            'IsTesting','iStochastic','IsTradeAllowed','IsTradeContextBusy','IsVisualMode','iTime','iVolume','iWPR','log','log10','MarketInfo','MathAbs',
            'MathArccos','MathArcsin','MathArctan','MathCeil','MathCos','MathExp','MathFloor','MathIsValidNumber','MathLog','MathLog10','MathMax','MathMin',
            'MathMod','MathPow','MathRand','MathRound','MathSin','MathSqrt','MathSrand','MathTan','MessageBox','Minute','Month','MQLInfoInteger','MQLInfoString',
            'MQLSetInteger','NormalizeDouble','ObjectCreate','ObjectDelete','ObjectDescription','ObjectFind','ObjectGet','ObjectGetDouble','ObjectGetFiboDescription',
            'ObjectGetInteger','ObjectGetShiftByValue','ObjectGetString','ObjectGetTimeByValue','ObjectGetValueByShift','ObjectGetValueByTime','ObjectMove',
            'ObjectName','ObjectsDeleteAll','ObjectSet','ObjectSetDouble','ObjectSetFiboDescription','ObjectSetInteger','ObjectSetString','ObjectSetText',
            'ObjectsTotal','ObjectType','OrderClose','OrderCloseBy','OrderClosePrice','OrderCloseTime','OrderComment','OrderCommission','OrderDelete',
            'OrderExpiration','OrderLots','OrderMagicNumber','OrderModify','OrderOpenPrice','OrderOpenTime','OrderPrint','OrderProfit','OrderSelect',
            'OrderSend','OrdersHistoryTotal','OrderStopLoss','OrdersTotal','OrderSwap','OrderSymbol','OrderTakeProfit','OrderTicket','OrderType','Period',
            'Period','PeriodSeconds','PlaySound','Point','pow','Print','PrintFormat','rand','RefreshRates','ResetLastError','ResourceCreate','ResourceFree',
            'ResourceReadImage','ResourceSave','round','Seconds','SendFTP','SendMail','SendNotification','SeriesInfoInteger','SetIndexArrow','SetIndexBuffer',
            'SetIndexDrawBegin','SetIndexEmptyValue','SetIndexLabel','SetIndexShift','SetIndexStyle','SetLevelStyle','SetLevelValue','ShortArrayToString',
            'ShortToString','SignalBaseGetDouble','SignalBaseGetInteger','SignalBaseGetString','SignalBaseSelect','SignalBaseTotal','SignalInfoGetDouble',
            'SignalInfoGetInteger','SignalInfoGetString','SignalInfoSetDouble','SignalInfoSetInteger','SignalSubscribe','SignalUnsubscribe','sin',
            'Sleep','sqrt','srand','StringAdd','StringBufferLen','StringCompare','StringConcatenate','StringFill','StringFind','StringFormat',
            'StringGetChar','StringGetCharacter','StringInit','StringLen','StringReplace','StringSetChar','StringSetCharacter','StringSplit','StringSubstr',
            'StringToCharArray','StringToColor','StringToDouble','StringToInteger','StringToLower','StringToShortArray','StringToTime','StringToUpper',
            'StringTrimLeft','StringTrimRight','StrToDouble','StrToInteger','StrToTime','StructToTime','Symbol','Symbol','SymbolInfoDouble','SymbolInfoInteger',
            'SymbolInfoSessionQuote','SymbolInfoSessionTrade','SymbolInfoString','SymbolInfoTick','SymbolName','SymbolSelect','SymbolsTotal','tan',
            'TerminalClose','TerminalCompany','TerminalInfoDouble','TerminalInfoInteger','TerminalInfoString','TerminalName','TerminalPath','TesterStatistics',
            'TextGetSize','TextOut','TextSetFont','TimeCurrent','TimeDay','TimeDaylightSavings','TimeDayOfWeek','TimeDayOfYear','TimeGMT','TimeGMTOffset',
            'TimeHour','TimeLocal','TimeMinute','TimeMonth','TimeSeconds','TimeToStr','TimeToString','TimeToStruct','TimeYear','UninitializeReason',
            'WebRequest','WindowBarsPerChart','WindowExpertName','WindowFind','WindowFirstVisibleBar','WindowHandle','WindowIsVisible','WindowOnDropped',
            'WindowPriceMax','WindowPriceMin','WindowPriceOnDropped','WindowRedraw','WindowScreenShot','WindowsTotal','WindowTimeOnDropped','WindowXOnDropped',
            'WindowYOnDropped','Year','ZeroMemory'
        ];

        return in_array($value , $mt4_commands);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The desired command was not found.';
    }
}
