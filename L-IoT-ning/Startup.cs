using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(L_IoT_ning.Startup))]
namespace L_IoT_ning
{
    public partial class Startup
    {
        public void Configuration(IAppBuilder app)
        {
            ConfigureAuth(app);
        }
    }
}
