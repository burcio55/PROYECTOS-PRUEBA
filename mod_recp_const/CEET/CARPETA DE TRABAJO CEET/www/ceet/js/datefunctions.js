<!--
var dias = new Array ("01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31")
//var meses = new Array ("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic")
var meses = new Array ("01","02","03","04","05","06","07","08","09","10","11","12")
var NombreDias = new Array("Sábado","Domingo","Lunes","Martes","Miércoles","Jueves","Viernes")

///////////////////////////////////////////////////////////////////////////////////////////////////////////
// Calcula la fecha del Domingo de Resurrección usando el algoritmo de Butcher (1876)
// Los resultados se dejan en: Dia_Res Ano_Res
// Algorithm por Juan Bautista José Delambre (Jean Baptiste Joseph Delambre) (1749-1822). 
// Este algoritmo es más conocido como el algoritmo de Butcher's (publicado en 1876) 
// quien a la vez lo obtuvo de un artículo anónimo en "Nature". 
//
// cidadaodomundo . weblog . com . pt / arquivo / 091530.html
//
// Para años anteriores a 1583 (Calendário Juliano):
// A = Ano MOD 4
// B = Ano MOD 7
// C = Ano MOD 19
// D = (19xC + 15) MOD 30
// E = (2xA + 4xB - D + 34) MOD 7
// F = (D + E + 114) MOD 31
// G = (D + E + 114) MOD 31
// La Pascua será el día G+1 del mes F
//
// Calendario Gregoriano (cualquier año a partir de 1583) 
// A = year
// B = year DIV 100 
// C = year MOD 100 
// D = B DIV 4
// E = B MOD 4
// F = (B + 8) DIV 25 
// G = (B - F + 1) DIV 3     
// H = (19 x A + B - D - G + 15) MOD 30     
// I = C DIV 4     
// K = C MOD 4     
// L = (32 + 2 x E + 2 x I - H - K) MOD 7     
// M = (A + 11 x H + 22 x L) DIV 451     
// P = 114 + H + L - 7 x M
// La Pascua será el día (p MOD 31)+1 del mes p DIV 31
////////////////////////////////////////////////////////////////////////////////////////////////////////////

function CalculePascua (Agno, Calendario) {
   if (Calendario == "GREGORIANO") {
      a=Agno%19
      b=Math.floor(Agno/100)
      c=Agno%100
      d=Math.floor(b/4)
      e=b%4
      f=Math.floor((b+8)/25)
      g=Math.floor((b-f+1)/3)
      h=(19*a+b-d-g+15)%30
      i=Math.floor(c/4)
      k=c%4
      l=(32+2*e+2*i-h-k)%7
      m=Math.floor((a+11*h+22*l)/451)
      p=(h+l-7*m+114)
      // Devuelve un registro Registro.Dia_Res / Registro.Mes_Res
      return {Dia : (p%31)+1, Mes : Math.floor(p/31)}
   } else if (Calendario == "JULIANO") {
      // Para años anteriores a 1583 (Calendário Juliano):
      a = Agno % 4
      b = Agno % 7
      c = Agno % 19
      d = (19*c + 15) % 30
      e = (2*a + 4*b - d + 34) % 7
      f = Math.floor((d + e + 114) / 31)
      g = (d + e + 114) % 31
      // Devuelve un registro Registro.Dia_Res / Registro.Mes_Res
      return {Dia : g+1, Mes : f}
   } else return {Dia : 0, Mes : 0}
} // CalculePascua

function ValideAno(Agno) {
// Verifica que el año esté entre 1583 y 2499.
var ok = false;
 if(Agno<1583) alert("¡El año debe ser posterior o igual a 1583!" )
 else if(Agno>2499) alert("¡El año debe ser anterior a 2499!" )
 else if(isNaN(Agno)) alert("¡El año debe estar entre 1583 y 2499!")
 else return (true);
 return (false);
} // ValideAno

function ValideFecha(dia,mes,agno) {
// Verifica la corrección de la fecha
// Año posterior al año 1
// Mes entre 1 y 12
// Días entre los días del mes (teniendo en cuenta si el año es bisiesto)
   var ok = false;
   var nd = numDiasMes(mes,agno)

   if (agno <= 0) alert("EL año debe ser igual o posterior al año 1")
   else if (mes<1 || mes>12) alert("¡El mes no existe.\nEl mes debe estar entre 1 y 12!")
   else if (dia<1 || dia>nd) alert(" ¡El día no existe.\nPara el mes dado, el día debe estar entre 1 y " + nd + "!")
   else if ((agno == 1582) && (mes == 10) && (dia > 4) && (dia < 15))
      alert ("¡Día suprimido de la reforma gregoriana del 1582");
   else return (true);
   return (false);
}  // Valide fecha
  
function EsBisiesto (Agno) {
// Los cálculos del año bisiesto cambiam a partir de la reforma Gregoriana del 1582
// 1. A partir Octubre 15 de 1582, i.e. a partir de 1583 (año > 1583): 
//    Un año es bisiesto si es divisible por 4, excepto aquellos divisibles por 100 pero no por 400.
// 2. Antes de Octubre 4 de 1582, i.e. antes de 1581 (año < 1583): 
//    Un año es bisiesto si es divisible por 4.
   if (Agno%4 == 0) {
      if (Agno > 1583)
         if (Agno%100 == 0 && Agno%400 != 0) { return false }
      return true
   } else { return false }
} // Es bisiesto
    
function numDiasMes(mes,Agno){
// Devuelve la cantidad de Dias del mes
// 0 si ha error
   if (mes<1 || mes>12 || Agno<=0) {  return 0 }

   if(mes==2) { 
   // Si un año es bisiesto, Febrero tendrá 29 días y no 28
      if (EsBisiesto (Agno)) return 29
      else return 28
   } 
   else if (mes==7) { return 31 }
   else { return 30 +((mes % 7) % 2) }
} // numDiasMes

function GetDayofWeek(dia,mes,agno) {
// Obtiene el día de la semana dada una fecha desde el año 1

   dia = parseInt(dia, 10);
   if (isNaN(dia))dia = 0; 

   mes = parseInt(mes, 10);
   if (isNaN(mes))mes = 0; 

   agno = parseInt(agno, 10);
   if (isNaN(agno))agno = 0; 

   if (!ValideFecha (dia, mes, agno)) return

   var s=0; var m=1;
   // Obtiene en "s" el número de días desde el 1 de enero hasta el mes actual
   while (m<mes) s += numDiasMes(m++,agno)
   
   // El siguiente cálculo es común antes y después de la reforma Gregoriana
   var w = agno + Math.floor((agno - 1) / 4) + s + dia;

   // Los siguientes cálculos dependen de si la fecha es antes o después de la reforma
   if ((agno < 1582) || ((agno == 1582) && (mes < 10)) || ((agno == 1582) && (mes == 10) && (dia < 5)))
      // Si la fecha es antes de la reforma Gregoriana 4-10-1582
      w = w - 2;
   else // Si la fecha es despues de la reforma Gregoriana 15-10-1582
      w = w - Math.floor((agno - 1) / 100) + Math.floor((agno - 1) / 400);

   var p = (w % 7);
   
   return p;
} // GetDayofWeek

function FechaRelativa (Dia, Mes, Agno, DiferenciaDias) {
// Devuelve un registro con dos enteros con una fecha relativa a la 
// Pascua (Resurrección), sumando (en forma positiva o negativa) 
// una cantidad de dias

   var ndiasmes=0

   if (DiferenciaDias == 0) return {Dia:Dia,Mes:Mes,Ano:Agno}
 
   if (DiferenciaDias > 0) {
      Dia++   
      // Avanza mes tras mes hasta llegar a la fecha relativa
      while (DiferenciaDias>0) {
         ndiasmes = numDiasMes(Mes,Agno)
         if (DiferenciaDias > ndiasmes - Dia + 1) {
            if (Mes < 12) { Mes++ }
            else { Mes=1; Agno++ }
            DiferenciaDias -= ndiasmes - Dia + 1;
            Dia = 1
         } else { 
            Dia += DiferenciaDias - 1
            DiferenciaDias = -1
         }
      } // end while
   } // Endif
   else { // DiferenciaDias > 0
      DiferenciaDias *= -1;
      while (DiferenciaDias>0) {
         if (DiferenciaDias >= Dia) {
            if (Mes > 1) {Mes--}
            else { Mes=12; Agno-- }
            // dias del mes anterior
            DiferenciaDias -= Dia;
            ndiasmes = numDiasMes(Mes,Agno)
            Dia = ndiasmes
         } else { 
            Dia -= DiferenciaDias
            DiferenciaDias = -1;
         }
      } // end while
   } // End else

   return {Dia : Dia, Mes : Mes, Ano : Agno}
} // FechaRelativa

function Date2String (Fec,NombreDia) {
// Devuelve una cadena con una fecha compuesta por Dia-Mes-Ano, 
// Fec es un registro con 3 campos: dia, mes ano

   CodDia=GetDayofWeek(Fec.Dia,Fec.Mes,Fec.Ano)
   return (dias[Fec.Dia-1] + "-" + meses[Fec.Mes-1] + "-" + Fec.Ano  + (NombreDia?", "+NombreDias[CodDia]:""));
} // Date2String

function NumDiasEntreDiasSemana (CodDiaIni,CodDiaFin,direccion) {
// Devuelve el número de días que hay entre dos dias de la semana (Lunes, Martes...Domingo)
// hacia adelanta o hacia atras
// direccion = 1 => hacia el futuro :: direccion = -1 => hacia el pasado
// codday[Ini,Fin] : codigo del día correspondiente a la fecha 0:sabado 1:domingo 2:lunes ... 6:viernes
   if (CodDiaIni==CodDiaFin) return 0
   else if (direccion == 1) {
	   if (CodDiaFin > CodDiaIni) return (CodDiaFin - CodDiaIni)
		else return (CodDiaFin + 7 - CodDiaIni)
	} else if (direccion == -1) return (CodDiaIni + 7 - CodDiaFin)%7
   else return -1
} // NumDaysBetweenWeekDays

//-->
