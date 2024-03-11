using System;
using System.Windows.Forms;
namespace WindowsApplication1
{
    public partial class Form1 : Form
    {
        public Form1()
        { InitializeComponent(); }



        private void btn_Calculate_Click(object sender, EventArgs e)
        {
            //Ініціалізація сторони та її зчитування
            byte Side;
            Side = byte.Parse(tb_Input.Text);

            //Ініціалізація периметра і площі та їх обрахунок 
            int P, S;
            P = 4 * Side;
            S = Side * Side;

            //Виведення периметра та площі квадрата
            lb_Perimeter.Text = "Периметр = " + P.ToString("#.##");
            lb_Square.Text = "Площа = " + S.ToString("#.##");
        }

        private void lb_Perimeter_Click(object sender, EventArgs e)
        {

        }

        private void lb_Square_Click(object sender, EventArgs e)
        {

        }

        private void tb_Input_TextChanged(object sender, EventArgs e)
        {

        }
    }
}
