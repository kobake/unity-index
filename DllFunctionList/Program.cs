using System;
using System.Collections.Generic;
using System.Linq;
using System.Reflection;
using System.Text;
using System.Threading.Tasks;

class Program
{
	static void Main(string[] args)
	{
		// Assembly assembly = Assembly.LoadFrom(@"C:\Program Files\Unity\Editor\Data\Managed\UnityEngine.dll");
		Assembly assembly = Assembly.LoadFrom(@"C:\Program Files\Unity5.2.2p1\Editor\Data\Managed\UnityEngine.dll");
		// Assembly assembly = Assembly.LoadFrom(@"C:\Program Files\Unity5.1.3p3\Editor\Data\Managed\UnityEditor.dll");
		
		foreach (Type type in assembly.GetTypes())
		{
			Console.WriteLine(type.ToString());
			/*
			MethodInfo[] methods = type.GetMethods();
			foreach (MethodInfo method in methods)
			{
				string name = method.Name;
				if (name == "ToString")continue;
				if (name == "CompareTo") continue;
				if (name == "GetType") continue;
				if (name == "GetTypeCode") continue;
				if (name == "HasFlag") continue;
				if (name == "Equals") continue;
				if (name == "GetHashCode") continue;
				Console.WriteLine("  " + method.ToString());
			}
			PropertyInfo[] properties = type.GetProperties();
			foreach (PropertyInfo property in properties)
			{
				string name = property.Name;
				if (name == "ToString") continue;
				if (name == "CompareTo") continue;
				if (name == "GetType") continue;
				if (name == "GetTypeCode") continue;
				if (name == "HasFlag") continue;
				if (name == "Equals") continue;
				if (name == "GetHashCode") continue;
				Console.WriteLine("  " + property.ToString());
			}
			 * */
			MemberInfo[] members = type.GetMembers();
			foreach (MemberInfo member in members)
			{
				string name = member.Name;
				if (name == ".ctor") continue;
				if (name == "ToString") continue;
				if (name == "CompareTo") continue;
				if (name == "GetType") continue;
				if (name == "GetTypeCode") continue;
				if (name == "HasFlag") continue;
				if (name == "Equals") continue;
				if (name == "GetHashCode") continue;
				Console.WriteLine("  " + member.ToString());
			}
		}
	}
}
