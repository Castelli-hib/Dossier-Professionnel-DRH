**Margin (m)**

Classe	Effet
m-0	margin: 0
m-0.5	0.125rem (2px)
m-1	0.25rem (4px)
m-2	0.5rem (8px)
m-3	0.75rem (12px)
m-4	1rem (16px)
m-5	1.25rem (20px)
m-6	1.5rem (24px)
m-8	2rem (32px)
m-10	2.5rem (40px)
m-12	3rem (48px)
m-16	4rem (64px)
m-auto	margin auto

Variantes directionnelles
Classe	  Effet
mt-4	    margin-top
mb-4	    margin-bottom
ml-4	    margin-left
mr-4	    margin-right
mx-4	    margin-left + margin-right
my-4	    margin-top + margin-bottom

**Padding (p)**

Exactement la même logique mais pour padding :

Classe	    Effet
p-0         → 0	
p-1         → 0.25rem	
p-2         → 0.5rem	
p-4         → 1rem	
p-6         → 1.5rem	
p-8         → 2rem	
p-12        → 3rem	


**Directionnelle**
Classe	Effet
pt-4	  padding-top
pb-4	  padding-bottom
pl-4	  padding-left
pr-4	  padding-right
px-4	  padding-left + padding-right
py-4	  padding-top + padding-bottom

**Responsive**

Combinaison avec les breakpoints :

<div class="mt-4 md:mt-8 lg:mt-12">


Petit écran → mt-4

Moyen (md:) → mt-8

Large (lg:) → mt-12

TAILWIND SPACING SCALE (REM)

Size   px     rem    Tailwind class
------------------------------------
0      0px    0      0
1      2px    0.125  0.5
2      4px    0.25   1
3      6px    0.375  1.5
4      8px    0.5    2
5      10px   0.625  2.5
6      12px   0.75   3
7      14px   0.875  3.5
8      16px   1      4
10     20px   1.25   5
12     24px   1.5    6
14     28px   1.75   7
16     32px   2      8
20     40px   2.5    10
24     48px   3      12
28     56px   3.5    14
32     64px   4      16

------------------------------------

**Usage examples:**

Margin:
m-4      → margin: 1rem
mt-6     → margin-top: 1.5rem
mx-8     → margin-left + margin-right: 2rem
my-2     → margin-top + margin-bottom: 0.5rem

Padding:
p-4      → padding: 1rem
pt-2     → padding-top: 0.5rem
px-6     → padding-left + padding-right: 1.5rem
py-8     → padding-top + padding-bottom: 2rem

Responsive:
mt-4 md:mt-8 lg:mt-12
  → petit écran: 1rem
  → medium: 2rem
  → large: 3rem

m = margin, p = padding
t/b/l/r/x/y = top / bottom / left / right / horizontal / vertical

TAILWIND SPACING CHEATSHEET (REM)

  SIZE    PX   REM      MARGIN (m-*)          PADDING (p-*)
---------------------------------------------------------------
  0       0px   0      m-0 / mt-0          p-0 / pt-0
  0.5     2px  0.125   m-0.5 / mt-0.5      p-0.5 / pt-0.5
  1       4px  0.25    m-1 / mt-1          p-1 / pt-1
  2       8px  0.5     m-2 / mt-2          p-2 / pt-2
  3       12px 0.75    m-3 / mt-3          p-3 / pt-3
  4       16px 1       m-4 / mt-4          p-4 / pt-4
  5       20px 1.25    m-5 / mt-5          p-5 / pt-5
  6       24px 1.5     m-6 / mt-6          p-6 / pt-6
  8       32px 2       m-8 / mt-8          p-8 / pt-8
 10       40px 2.5     m-10 / mt-10        p-10 / pt-10
 12       48px 3       m-12 / mt-12        p-12 / pt-12
 16       64px 4       m-16 / mt-16        p-16 / pt-16

-----------------------------------------------
DIRECTIONAL SHORTHANDS:
t = top, b = bottom, l = left, r = right
x = left + right, y = top + bottom

EXAMPLES:
-------------------------------
mt-8        → margin-top: 2rem
mb-4        → margin-bottom: 1rem
mx-6        → margin-left + margin-right: 1.5rem
my-2        → margin-top + margin-bottom: 0.5rem

pt-4        → padding-top: 1rem
pb-2        → padding-bottom: 0.5rem
px-8        → padding-left + padding-right: 2rem
py-6        → padding-top + padding-bottom: 1.5rem

RESPONSIVE:
-------------------------------
mt-4 md:mt-8 lg:mt-12
  → petit écran: 1rem
  → moyen écran: 2rem
  → grand écran: 3rem
