<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ligne;

class Lignes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ligne::create( [
            'id'=>1,
            'name'=>'L1',
            'Length'=>4,
            'arrets'=>'[\"3\",\"1\",\"2\",\"4\"]',
            'deleted_at'=>'2022-10-16 12:45:38',
            'created_at'=>'2022-08-15 19:55:06',
            'updated_at'=>'2022-10-16 12:45:38',
            'maps'=>'ssxuEtpzBLc@KiBKwAE_AIuAE}AJUNUXIr@Er@IlAKzAYPEp@JRGZSJa@Fm@Yy@[Oi@CWJYM]_@eCcEeCyDyFgJsAuBoD}FuA_CiC_EcAkBmAoBMUwCuEs@aCeAwEm@sC}@gEw@uD{@uD{BkJSs@?m@Bi@Ci@YQ_@JO\\IPuFjDgBbA}HxEsBhAgF`D{BlAeHpCuIjBq@BYESQWKYHMJM@eDD}@KeAYi@_@i@a@}@}@uBuAmA}@qAaA{CwBq@[_@Om@OcA_@SK]i@@WFiAFi@^cCj@uEHkADa@PMd@s@?s@KeAQo@Q]AuBAgAD}B@uAEGy@AiCCu@IcCDwAIi@AsBK{ACW?Ap@MnGCfA',
            'color'=>'0xffff0000'
            ] );
            
            
                        
            Ligne::create( [
            'id'=>2,
            'name'=>'L2',
            'Length'=>5,
            'arrets'=>'[\"1\",\"2\",\"3\",\"5\",\"4\"]',
            'deleted_at'=>'2022-10-16 12:45:41',
            'created_at'=>'2022-08-16 15:13:43',
            'updated_at'=>'2022-10-16 12:45:41',
            'maps'=>NULL,
            'color'=>NULL
            ] );
            
            
                        
            Ligne::create( [
            'id'=>3,
            'name'=>'Ligne 03B',
            'Length'=>11,
            'arrets'=>'[\"29\",\"30\",\"31\",\"32\",\"33\",\"34\",\"40\",\"41\",\"42\",\"38\",\"43\"]',
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-16 12:53:50',
            'updated_at'=>'2022-10-16 16:38:41',
            'maps'=>'ctxuEnmzBJUAs@I_@OAy@n@H~BXfFFjALfA?N_@Xk@NoHx@uE`@uAJoI`AuD\\}AL{AHkA?u@Xm@\\GX?n@KxBOxBq@dJUbCc@vFWtDQnAYhA{HhL|H~QzEhKdDjHtDjHw@bA}KcAyEpCuBrSgOvIsCuAsAjAmF}AcGiEeFgEMm@QW]I]Gu@i@_FyDaIcGuJyHiB}A}AcBmAgB`@c@hAQjBSrKyAfDy@|VcEdHeBb@vFaFdMoBlEnDxBtDsGxLkS|D{GzDiGfAwB',
            'color'=>'0xff00ff44'
            ] );
            
            
                        
            Ligne::create( [
            'id'=>4,
            'name'=>'Ligne 09 ',
            'Length'=>14,
            'arrets'=>'[\"29\",\"44\",\"45\",\"46\",\"47\",\"48\",\"49\",\"50\",\"51\",\"52\",\"53\",\"54\",\"55\",\"56\"]',
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-16 12:55:57',
            'updated_at'=>'2022-10-16 12:55:57',
            'maps'=>'ssxuEtpzBLc@KiBKwAE_AIuAE}AJUNUXIr@Er@IlAKzAYPEp@JRGZSJa@Fm@Yy@[Oi@CWJYM]_@eCcEeCyDyFgJsAuBoD}FuA_CiC_EcAkBmAoBMUwCuEs@aCeAwEm@sC}@gEw@uD{@uD{BkJSs@?m@Bi@Ci@YQ_@JO\\IPuFjDgBbA}HxEsBhAgF`D{BlAeHpCuIjBq@BYESQWKYHMJM@eDD}@KeAYi@_@i@a@}@}@uBuAmA}@qAaA{CwBq@[_@Om@OcA_@SK]i@@WFiAFi@^cCj@uEHkADa@PMd@s@?s@KeAQo@Q]AuBAgAD}B@uAEGy@AiCCu@IcCDwAIi@AsBK{ACW?Ap@MnGCfA',
            'color'=>'0xff000080'
            ] );
            
            
                        
            Ligne::create( [
            'id'=>5,
            'name'=>'Ligne 16',
            'Length'=>18,
            'arrets'=>'[\"29\",\"44\",\"57\",\"58\",\"59\",\"60\",\"61\",\"62\",\"63\",\"64\",\"49\",\"50\",\"51\",\"52\",\"53\",\"54\",\"65\",\"66\"]',
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-16 12:58:11',
            'updated_at'=>'2022-10-24 12:17:26',
            'maps'=>'atxuEbozBTMi@kLb@c@lGk@t@Kd@Hj@[XmAUy@q@YMw@a@oGaAsR}AiVw@gLoBa][uD}B?}JE_LHq@Fg@n@K|@HtFa@Fy@B]FsCv@OF[aAq@{Cm@eCm@kC[yA?q@@s@W_@]?YXK`@cAt@eIpEuBxAcK`GiEhCgCjAqEhByB\\eDn@uALe@GS_@_@?[TaBFqB?q@OsAm@kCwBeCkBaBuAoCmBkBu@{Bo@[o@s@Ua@LOj@Nv@L^MnDU`KShCi@rL]jKOtFWr@[z@^jAl@Fn@WJu@ScASa@Eo@',
            'color'=>'0xffdfff00'
            ] );
            
            
                        
            Ligne::create( [
            'id'=>6,
            'name'=>'Ligne 11',
            'Length'=>16,
            'arrets'=>'[\"67\",\"68\",\"99\",\"100\",\"101\",\"102\",\"103\",\"104\",\"105\",\"106\",\"107\",\"108\",\"109\",\"110\",\"111\",\"112\"]',
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-16 13:03:20',
            'updated_at'=>'2022-10-24 12:22:42',
            'maps'=>'o~yuElezBKq@_ANf@|E\\`Bp@hAdAfAfEdDxIrGd@CzEe@~H{@~@Eb@?\\Tn@@VYp@c@dCS`Fg@vEg@|CUd@lGjBtXhAEr@BfAlCrAfDvAzC\\\\t@ZpE|BlEtBvFpAhH`BdJbC~@`@|@dA`@~@JtFInCe@hJUhEWXeBn@_D`@}Hz@qBToFXu@V_EnAj@jBjCnIxCvIjE~LPx@R`@LV^`CpFvPjEfMxC|IjFrO~ChJdE`MrBbHv@hChDjHpGzHzDpFfF|HrC~E~@|CfBjJ`@`BlC|DrAb@fAx@^Zl@@fA`ClHlM@d@Cj@_@jBqCdMnAj@pHrCxHxCzOnKjDnBnYxSrKhHTnJ{Hi@}K}Aq@eE',
            'color'=>'0xfff513f5'
            ] );
            
            
                        
            Ligne::create( [
            'id'=>7,
            'name'=>'Ligne 25',
            'Length'=>13,
            'arrets'=>'[\"67\",\"68\",\"70\",\"71\",\"72\",\"73\",\"74\",\"75\",\"76\",\"77\",\"78\",\"79\",\"131\"]',
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-16 13:05:39',
            'updated_at'=>'2022-10-25 18:25:52',
            'maps'=>'u~yuE`ezBI_@u@Pl@bGvArCfB~ApMbKbEMrLkAtA?`@J`@Eh@m@x@MhK}@`LmAlBk@|AqAjA{ArByCtNiTrHiL^i@ROAc@I_@eAqEmAqFq@kDoBmJ}AmH_A{EQ{AIy@@_@E_AFu@Z}BxBeOrBqNdB}KxAgJx@{FrBsNfD{Tp@eFvBeOfCgPdAaHvAsJ~@gG`@{BdAgHh@}D~AeKReAPi@GWtCqVzHmSxLmXlAgQGuPi@{RxC}i@{DcPMwCGuA[[}AnDmBtCyCrD}@pAi@s@e@cAo@gCu@{F',
            'color'=>'0xff000000'
            ] );
            
            
                        
            Ligne::create( [
            'id'=>8,
            'name'=>'ligne 26',
            'Length'=>22,
            'arrets'=>'[\"67\",\"68\",\"70\",\"71\",\"72\",\"73\",\"74\",\"75\",\"76\",\"80\",\"81\",\"82\",\"83\",\"84\",\"85\",\"86\",\"87\",\"88\",\"89\",\"90\",\"131\",\"132\"]',
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-16 13:07:44',
            'updated_at'=>'2022-10-26 13:32:08',
            'maps'=>'c_zuE|dzBI[o@LTfC`@bCh@nAr@fAbA|@fAz@bMhJpO{A`AMz@?XGZb@n@KZYb@[tFg@hNuAxBY`AY|@_@lAmAbAqAxBgDlEeHbH{JdDcF~CeF\\WOm@Os@aBcIw@gDmDoPqAmGc@cC[gCCy@CcBbEgYtHug@~Fu`@vCyS`Fw[pIik@nBmMT_@Ag@FuAjC}QtAmFvAwDvEkKrF_MjAsDj@uDv@kHXkFDyMM}IG_J^kH`AmTXiIc@uCsCgKa@iFB]M[IwBw@}RsAqYgAuTkBo[q^cbHyAy][uPt@og@Zg\\DqIp@au@n@wu@bAq@dHhB~UbF~InBnZxGvh@bMdVjExGsVlM}DtHdW',
            'color'=>'0xffff0000'
            ] );
            
            
                        
            Ligne::create( [
            'id'=>9,
            'name'=>'Ligne 27',
            'Length'=>13,
            'arrets'=>'[\"67\",\"68\",\"70\",\"71\",\"91\",\"92\",\"93\",\"94\",\"95\",\"96\",\"97\",\"98\",\"131\"]',
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-16 13:10:13',
            'updated_at'=>'2022-10-24 18:41:22',
            'maps'=>'y_zuE|dzBEU]F\\xDZxAh@rAlAtApAhApDnChHlFdFe@nKcAz@Ab@\\f@Mh@a@b@QtQgBdFi@hA[v@Yj@k@`BiBdD}EhEaHtAkBnEsGxGgK`@e@NOtU{]tE}GfD\\nBnFbExH`DoB~DwBvAi@sJiWvB_C|DuCrRmPxYaVzGoFjh@cc@re@s_@rZ_`@nIiCrFoA|DkDfJyH~LsK|]_YlX{GvP_Ba@qIM}D_Gie@oFeb@oIcJiC{FiAmQoFtA',
            'color'=>'0xffccccff'
            ] );
            
            
                        
            Ligne::create( [
            'id'=>10,
            'name'=>'Ligne 28 ',
            'Length'=>19,
            'arrets'=>'[\"67\",\"113\",\"114\",\"115\",\"116\",\"117\",\"118\",\"119\",\"120\",\"121\",\"122\",\"123\",\"124\",\"125\",\"126\",\"127\",\"128\",\"129\",\"130\"]',
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-16 13:12:56',
            'updated_at'=>'2022-10-16 13:12:56',
            'maps'=>'c_zuEtdzBASs@H_@yCc@qAu@s@o@_@oLeHoDoBqCoDsD{EkIuN_K}Q_AuAsAkCa@cAy@mEHq@Bq@[a@i@LONyECm@Ko@O_Ay@aLsIq@q@gBs@qC{@O]]_@c@B_@PkBi@qDsAqDu@iFOcK[e@O[CONiABgOKoIYwKYuC[mDc@oA]cAe@qBeAkA}@uAmBcB_EoAoE{CqKeD{IwBkJoB_PoBiJmAiEiBmD_BiAoJqEqFkCgEgBeBs@sAeAgFkHuKcSkMuQeC_JcBaF{BaEo[mYvGiRBwQ_M{ZmQiR_FmEev@dBoW?iiC}PFcDc@cHcCoMq@qKqEsKuRs^',
            'color'=>'0xffb74093'
            ] );
            
            
                        
            Ligne::create( [
            'id'=>11,
            'name'=>'Ligne Touristique : Lac sidi mohamed benali',
            'Length'=>11,
            'arrets'=>'[\"29\",\"133\",\"134\",\"135\",\"136\",\"137\",\"138\",\"139\",\"140\",\"141\",\"142\"]',
            'deleted_at'=>NULL,
            'created_at'=>'2023-01-17 14:37:34',
            'updated_at'=>'2023-01-17 14:38:51',
            'maps'=>'utxuEnozBl@}@SwBqARv@dOIhAkALuCTyK~@}@Em@m@cIeGiEoDo@iAWs@]cBg@mF_@aCwAiBkBcAW[_@SkNgIsA_Bi@Y]o@Ig@XsBPYt@?JTFd@Gn@iA~@iCnAuEdCq@EcAQoAWaCOuBTyBpAoGbEg@La@GeAK[VGx@Qr@V^nA`@~@j@r@dBRf@`@xAb@hAP|AEjCOpCc@|HCfBIvCIt@qCe@{MwDmIyBiLoCeBa@_JsBsM}CQqC{AOcGJ]e@ZuBXyARu@Vk@@i@Wa@]A[RGj@Lb@Jp@{@jFkDhRwB|KSLc@d@iAF_Gc@kCOsBLgEj@q@PaAx@oBvC_CpDgAbBgCpCaBbCgFrIsCtE{DxFWRIP{DdGONcAQqCi@oAIoAJiCC}@c@e@c@Ui@?c@JaACa@e@UkAAu@SeBNa@Ia@s@Yc@aBy@s@e@_@CiB~Ba@Le@Aq@@wCjAoCpBeAnAs@bBS~@It@?lAHvBTxBh@~DXbER~C^`Bj@r@x@v@b@fAZvBBjAR~Aj@|AZBTi@fAiBt@_Az@o@p@[p@O|Cc@z@Cf@_@t@wBd@eBv@y@Nu@?s@Fm@n@eBv@sAv@_@j@?bAXZALMf@uBl@oAt@{@`@SVWj@_@vAoBv@sAT_A',
            'color'=>'0xff8e44ad'
            ] );
    }
}
