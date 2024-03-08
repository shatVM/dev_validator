namespace WindowsApplication1
{
    partial class Form1
    {
        /// <summary>
        /// Обязательная переменная конструктора.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Освободить все используемые ресурсы.
        /// </summary>
        /// <param name="disposing">истинно, если управляемый ресурс должен быть удален; иначе ложно.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Код, автоматически созданный конструктором форм Windows

        /// <summary>
        /// Требуемый метод для поддержки конструктора — не изменяйте 
        /// содержимое этого метода с помощью редактора кода.
        /// </summary>
        private void InitializeComponent()
        {
            this.btn_Calculate = new System.Windows.Forms.Button();
            this.lb_Perimeter = new System.Windows.Forms.Label();
            this.tb_Input = new System.Windows.Forms.TextBox();
            this.lb_Square = new System.Windows.Forms.Label();
            this.SuspendLayout();
            // 
            // btn_Calculate
            // 
            this.btn_Calculate.BackColor = System.Drawing.Color.PaleGreen;
            this.btn_Calculate.Location = new System.Drawing.Point(62, 212);
            this.btn_Calculate.Name = "btn_Calculate";
            this.btn_Calculate.Size = new System.Drawing.Size(442, 62);
            this.btn_Calculate.TabIndex = 1;
            this.btn_Calculate.Text = "Обчислити";
            this.btn_Calculate.UseVisualStyleBackColor = false;
            this.btn_Calculate.Click += new System.EventHandler(this.btn_Calculate_Click);
            // 
            // lb_Perimeter
            // 
            this.lb_Perimeter.AutoSize = true;
            this.lb_Perimeter.Font = new System.Drawing.Font("Microsoft Sans Serif", 20F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.lb_Perimeter.Location = new System.Drawing.Point(307, 70);
            this.lb_Perimeter.Name = "lb_Perimeter";
            this.lb_Perimeter.Size = new System.Drawing.Size(197, 31);
            this.lb_Perimeter.TabIndex = 2;
            this.lb_Perimeter.Text = "Периметр = 0";
            // 
            // tb_Input
            // 
            this.tb_Input.Location = new System.Drawing.Point(62, 70);
            this.tb_Input.Name = "tb_Input";
            this.tb_Input.Size = new System.Drawing.Size(227, 38);
            this.tb_Input.TabIndex = 3;
            this.tb_Input.Text = "0";
            // 
            // lb_Square
            // 
            this.lb_Square.AutoSize = true;
            this.lb_Square.Font = new System.Drawing.Font("Microsoft Sans Serif", 20F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.lb_Square.Location = new System.Drawing.Point(307, 124);
            this.lb_Square.Name = "lb_Square";
            this.lb_Square.Size = new System.Drawing.Size(155, 31);
            this.lb_Square.TabIndex = 2;
            this.lb_Square.Text = "Площа = 0";
            // 
            // Form1
            // 
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.None;
            this.BackgroundImageLayout = System.Windows.Forms.ImageLayout.None;
            this.ClientSize = new System.Drawing.Size(584, 361);
            this.Controls.Add(this.tb_Input);
            this.Controls.Add(this.lb_Square);
            this.Controls.Add(this.lb_Perimeter);
            this.Controls.Add(this.btn_Calculate);
            this.Font = new System.Drawing.Font("Microsoft Sans Serif", 20F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(204)));
            this.ForeColor = System.Drawing.SystemColors.ControlText;
            this.Location = new System.Drawing.Point(400, 400);
            this.Name = "Form1";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Квадрат";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion
        private System.Windows.Forms.Button btn_Calculate;
        private System.Windows.Forms.Label lb_Perimeter;
        private System.Windows.Forms.TextBox tb_Input;
        private System.Windows.Forms.Label lb_Square;
    }
}

