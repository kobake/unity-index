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
		try
		{
			Main2(args);
		}
		catch (Exception ex)
		{
			Console.WriteLine(ex);
		}
	}
	static Type[] GetTypes(Assembly assembly)
	{
		try
		{
			return assembly.GetTypes();
		}
		catch (ReflectionTypeLoadException ex)
		{
			return ex.Types;
		}
	}
	static void Main2(string[] args)
	{
		string dllPath = args[0];
		//Assembly assembly = Assembly.LoadFrom(@"C:\Program Files\Unity5.2.3p1\Editor\Data\Managed\UnityEditor.dll");
		Assembly assembly = Assembly.LoadFrom(dllPath);

		foreach (Type type in GetTypes(assembly))
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
